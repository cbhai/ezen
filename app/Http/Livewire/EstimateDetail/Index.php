<?php

namespace App\Http\Livewire\EstimateDetail;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
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
            'except' => 'estimate.title',
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
        $this->sortBy            = 'estimate.title';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new EstimateDetail())->orderable;
    }

    public function render()
    {
        $query = EstimateDetail::with(['estimate', 'room', 'owner'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $estimateDetails = $query->paginate($this->perPage);

        return view('livewire.estimate-detail.index', compact('query', 'estimateDetails', 'estimateDetails'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('estimate_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        EstimateDetail::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(EstimateDetail $estimateDetail)
    {
        abort_if(Gate::denies('estimate_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateDetail->delete();
    }
}
