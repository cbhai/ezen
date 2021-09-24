<?php

namespace App\Http\Livewire\Term;

use App\Models\Term;
use Livewire\Component;

class Create extends Component
{
    public Term $term;

    public function mount(Term $term)
    {
        $this->term = $term;
    }

    public function render()
    {
        return view('livewire.term.create');
    }

    public function submit()
    {
        $this->validate();

        $this->term->save();

        return redirect()->route('admin.terms.index');
    }

    protected function rules(): array
    {
        return [
            'term.terms' => [
                'string',
                'required',
            ],
        ];
    }
}
