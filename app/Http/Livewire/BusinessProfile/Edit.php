<?php

namespace App\Http\Livewire\BusinessProfile;

use App\Models\BusinessProfile;
use Livewire\Component;

class Edit extends Component
{
    public BusinessProfile $businessProfile;

    public function mount(BusinessProfile $businessProfile)
    {
        $this->businessProfile = $businessProfile;
    }

    public function render()
    {
        return view('livewire.business-profile.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->businessProfile->save();

        return redirect()->route('admin.business-profiles.index');
    }

    protected function rules(): array
    {
        return [
            'businessProfile.business_name' => [
                'string',
                'required',
            ],
            'businessProfile.first_name' => [
                'string',
                'required',
            ],
            'businessProfile.last_name' => [
                'string',
                'required',
            ],
            'businessProfile.phone' => [
                'string',
                'required',
            ],
            'businessProfile.email' => [
                'email:rfc',
                'required',
            ],
            'businessProfile.address' => [
                'string',
                'required',
            ],
            'businessProfile.city' => [
                'string',
                'required',
            ],
            'businessProfile.state' => [
                'string',
                'required',
            ],
            'businessProfile.pin_code' => [
                'string',
                'required',
            ],
            'businessProfile.about' => [
                'string',
                'nullable',
            ],
        ];
    }
}
