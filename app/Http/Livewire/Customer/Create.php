<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;

class Create extends Component
{
    public Customer $customer;

    public array $listsForFields = [];

    public function mount(Customer $customer)
    {
        $this->customer = $customer;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.customer.create');
    }

    public function submit()
    {
        $this->validate();

        $this->customer->save();

        return redirect()->route('admin.customers.index');
    }

    protected function rules(): array
    {
        return [
            'customer.first_name' => [
                'string',
                'required',
            ],
            'customer.last_name' => [
                'string',
                'required',
            ],
            'customer.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'customer.email' => [
                'email:rfc',
                'required',
            ],
            'customer.phone' => [
                'string',
                'required',
            ],
            'customer.address' => [
                'string',
                'nullable',
            ],
            'customer.city' => [
                'string',
                'required',
            ],
            'customer.state' => [
                'string',
                'required',
            ],
            'customer.description' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['status'] = $this->customer::STATUS_SELECT;
    }
}
