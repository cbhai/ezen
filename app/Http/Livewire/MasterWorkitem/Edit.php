<?php

namespace App\Http\Livewire\MasterWorkitem;

use App\Models\MasterRoom;
use App\Models\MasterWorkitem;
use Livewire\Component;

class Edit extends Component
{
    public array $listsForFields = [];

    public MasterWorkitem $masterWorkitem;

    public function mount(MasterWorkitem $masterWorkitem)
    {
        $this->masterWorkitem = $masterWorkitem;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.master-workitem.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->masterWorkitem->save();

        return redirect()->route('admin.master-workitems.index');
    }

    protected function rules(): array
    {
        return [
            'masterWorkitem.room_id' => [
                'integer',
                'exists:master_rooms,id',
                'required',
            ],
            'masterWorkitem.name' => [
                'string',
                'required',
            ],
            'masterWorkitem.description' => [
                'string',
                'required',
            ],
            'masterWorkitem.unit' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['unit'])),
            ],
            'masterWorkitem.rate' => [
                'numeric',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['room'] = MasterRoom::pluck('name', 'id')->toArray();
        $this->listsForFields['unit'] = $this->masterWorkitem::UNIT_SELECT;
    }
}
