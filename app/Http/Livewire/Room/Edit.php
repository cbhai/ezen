<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Edit extends Component
{
    public Room $room;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.room.edit');
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
                //'unique:rooms,name,' . $this->room->id,
            ],
            'room.description' => [
                'string',
                'required',
            ],
        ];
    }
}
