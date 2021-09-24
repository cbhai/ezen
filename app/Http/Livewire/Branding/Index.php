<?php

namespace App\Http\Livewire\Branding;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Branding;
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
        $this->orderable         = (new Branding())->orderable;
    }

    public function render()
    {
        $query = Branding::with(['owner'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $brandings = $query->paginate($this->perPage);

        return view('livewire.branding.index', compact('query', 'brandings', 'brandings'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('branding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Branding::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Branding $branding)
    {
        abort_if(Gate::denies('branding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branding->delete();
    }
}
