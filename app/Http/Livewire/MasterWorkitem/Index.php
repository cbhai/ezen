<?php

namespace App\Http\Livewire\MasterWorkitem;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\MasterWorkitem;
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
            'except' => 'room.name',
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
        $this->sortBy            = 'room.name';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new MasterWorkitem())->orderable;
    }

    public function render()
    {
        $query = MasterWorkitem::with(['room'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $masterWorkitems = $query->paginate($this->perPage);

        return view('livewire.master-workitem.index', compact('query', 'masterWorkitems', 'masterWorkitems'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('master_workitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        MasterWorkitem::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(MasterWorkitem $masterWorkitem)
    {
        abort_if(Gate::denies('master_workitem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $masterWorkitem->delete();
    }
}
