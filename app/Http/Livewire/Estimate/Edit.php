<?php

namespace App\Http\Livewire\Estimate;

use App\Models\Customer;
use App\Models\Estimate;
use Livewire\Component;

class Edit extends Component
{
    public Estimate $estimate;

    public array $listsForFields = [];

    public function mount(Estimate $estimate)
    {
        $this->estimate = $estimate;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.estimate.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->estimate->save();

        return redirect()->route('admin.estimates.index');
    }

    protected function rules(): array
    {
        return [
            'estimate.title' => [
                'string',
                'required',
            ],
            'estimate.customer_id' => [
                'integer',
                'exists:customers,id',
                'required',
            ],
            'estimate.date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'estimate.terms' => [
                'string',
                'nullable',
            ],
            'estimate.header' => [
                'boolean',
            ],
            'estimate.footer' => [
                'boolean',
            ],
            'estimate.total' => [
                'numeric',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['customer'] = Customer::pluck('first_name', 'id')->toArray();
    }
}
