<?php

namespace App\Http\Livewire\EstimateDetail;

use App\Models\Estimate;
use App\Models\EstimateDetail;
use App\Models\Room;
use Livewire\Component;

class Edit extends Component
{
    public array $listsForFields = [];

    public EstimateDetail $estimateDetail;

    public function mount(EstimateDetail $estimateDetail)
    {
        $this->estimateDetail = $estimateDetail;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.estimate-detail.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->estimateDetail->save();

        return redirect()->route('admin.estimate-details.index');
    }

    protected function rules(): array
    {
        return [
            'estimateDetail.estimate_id' => [
                'integer',
                'exists:estimates,id',
                'required',
            ],
            'estimateDetail.room_id' => [
                'integer',
                'exists:rooms,id',
                'required',
            ],
            'estimateDetail.name' => [
                'string',
                'required',
            ],
            'estimateDetail.description' => [
                'string',
                'required',
            ],
            'estimateDetail.rate' => [
                'numeric',
                'required',
            ],
            'estimateDetail.unit' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['unit'])),
            ],
            'estimateDetail.quantity' => [
                'numeric',
                'required',
            ],
            'estimateDetail.total' => [
                'numeric',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['estimate'] = Estimate::pluck('title', 'id')->toArray();
        $this->listsForFields['room']     = Room::pluck('name', 'id')->toArray();
        $this->listsForFields['unit']     = $this->estimateDetail::UNIT_SELECT;
    }
}
