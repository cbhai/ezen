<?php

namespace App\Http\Livewire\Estimate;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Estimate;
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

        Estimate::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Estimate $estimate)
    {
        abort_if(Gate::denies('estimate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimate->delete();
    }
}
