<?php

namespace App\Http\Livewire\Workitem;

use App\Models\Room;
use App\Models\Workitem;
use Livewire\Component;

class Edit extends Component
{
    public Workitem $workitem;

    public array $listsForFields = [];

    public function mount(Workitem $workitem)
    {
        $this->workitem = $workitem;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.workitem.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->workitem->save();

        return redirect()->route('admin.workitems.index');
    }

    protected function rules(): array
    {
        return [
            'workitem.room_id' => [
                'integer',
                'exists:rooms,id',
                'required',
            ],
            'workitem.name' => [
                'string',
                'required',
                'unique:workitems,name,' . $this->workitem->id . ',id,room_id,' . $this->workitem->room_id . ',owner_id,' . auth()->id(),
            ],
            'workitem.description' => [
                'string',
                'required',
            ],
            'workitem.rate' => [
                'numeric',
                'required',
            ],
            'workitem.unit' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['unit'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['room'] = Room::pluck('name', 'id')->toArray();
        $this->listsForFields['unit'] = $this->workitem::UNIT_SELECT;
    }
}
