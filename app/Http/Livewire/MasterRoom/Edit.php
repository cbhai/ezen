<?php

namespace App\Http\Livewire\MasterRoom;

use App\Models\MasterRoom;
use Livewire\Component;

class Edit extends Component
{
    public MasterRoom $masterRoom;

    public function mount(MasterRoom $masterRoom)
    {
        $this->masterRoom = $masterRoom;
    }

    public function render()
    {
        return view('livewire.master-room.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->masterRoom->save();

        return redirect()->route('admin.master-rooms.index');
    }

    protected function rules(): array
    {
        return [
            'masterRoom.name' => [
                'string',
                'required',
                'unique:master_rooms,name,' . $this->masterRoom->id,
            ],
            'masterRoom.description' => [
                'string',
                'required',
            ],
        ];
    }
}
