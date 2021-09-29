<?php

namespace App\Http\Livewire\Estimate;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Estimate;
use App\Models\EstimateDetail;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithSorting;
    use WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'title',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'title';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Estimate())->orderable;
    }

    public function render()
    {
        $query = Estimate::with(['customer', 'owner'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $estimates = $query->paginate($this->perPage);

        return view('livewire.estimate.index', compact('query', 'estimates', 'estimates'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('estimate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //Estimate::whereIn('id', $this->selected)->delete();
        $estimates = Estimate::whereIn('id', $this->selected)->get();

        foreach($estimates as $estimate){
            $estimate->estimateDetails->each->delete();
        }
        $estimates->each->delete();

        $this->resetSelected();
    }

    public function delete(Estimate $estimate)
    {
        abort_if(Gate::denies('estimate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimate->estimateDetails->each->delete();
        $estimate->delete();

    }
    public function duplicate(Estimate $estimate)
    {
        $newEstimate = $estimate->replicate();

        $newEstimate->title = 'Copy of - ' . $estimate->title;

        $newEstimate->save();

        $newParentId = $newEstimate->id;

        $childEstimateDetails = EstimateDetail::where('estimate_id', $estimate->id)->get();

        $childEstimateDetails->each(function ($child) use ($newParentId){
            $replica = $child->replicate()->fill([
                'estimate_id'   =>  $newParentId,
            ]);
            $replica->save();
        });

    }
}
