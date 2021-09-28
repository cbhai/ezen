<?php

namespace App\Http\Livewire\Estimate;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Estimate;
use Carbon\Carbon;
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
        $estimate = Estimate::whereIn('id', $this->selected)->get();
        $estimate->estimateDetails->each->delete();
        $estimate->delete();

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
        //dd($estimate->title);
        //Replicate code here
        $newEstimate = $estimate->replicate();

        $newEstimate->title = 'Copy of - ' . $estimate->title;
        $newEstimate->created_at = Carbon::now();
        $newEstimate->updated_at = Carbon::now();

        $newEstimate->save();
        //dd($newEstimate);


        // Fetch all EstimateDetails
        //loop through it to change - estimate_id, created_at, updated_at

        /****

        $parentId = 1; // just an example

        $children->each(function ($child) use ($parentId) {
            $replica = $child->replicate()->fill([
                'parent_id' => $parentId
            ]);

            $replica->save();
        });



        */
    }
}
