<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    public Room $room;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.room.create');
    }

    public function submit()
    {
        $this->validate();

        $this->room->save();

        return redirect()->route('admin.rooms.index');
    }

    protected function rules(): array
    {
        return [
            'room.name' => [
                'string',
                'required',
                'unique:rooms,name,null,id,owner_id,' . auth()->id(),
            ],
            'room.description' => [
                'string',
                'required',
            ],
        ];
    }
}
