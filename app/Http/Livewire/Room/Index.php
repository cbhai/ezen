<?php

namespace App\Http\Livewire\Room;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Room;
use App\Models\Workitem;
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
            'except' => 'name',
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
        $this->sortBy            = 'name';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Room())->orderable;
    }

    public function render()
    {
        $query = Room::with(['owner'])->advancedFilter([
            's'               => $this->search ?: null,
            'order_column'    => $this->sortBy,
            'order_direction' => $this->sortDirection,
        ]);

        $rooms = $query->paginate($this->perPage);

        return view('livewire.room.index', compact('query', 'rooms', 'rooms'));
    }

    public function deleteSelected()
    {
        abort_if(Gate::denies('room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rooms = Room::whereIn('id', $this->selected)->get();

        foreach($rooms as $room){
            $room->workitems->each->delete();
        }
        $rooms->each->delete();

        //Room::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Room $room)
    {
        abort_if(Gate::denies('room_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $room->workitems->each->delete();
        $room->delete();
    }
    public function duplicate(Room $room)
    {
        $newRoom = $room->replicate();

        $newRoom->name = 'Copy of - ' . $room->name;

        $newRoom->save();

        $newParentId = $newRoom->id;

        $childWorkitems = Workitem::where('room_id', $room->id)->get();

        $childWorkitems->each(function ($child) use ($newParentId){
            $replica = $child->replicate()->fill([
                'room_id'   =>  $newParentId,
            ]);
            $replica->save();
        });
    }
}
