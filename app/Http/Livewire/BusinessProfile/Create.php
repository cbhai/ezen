<?php

namespace App\Http\Livewire\BusinessProfile;

use App\Models\Branding;
use App\Models\BusinessProfile;
use Livewire\Component;

class Create extends Component
{
    public BusinessProfile $businessProfile;

    public function mount(BusinessProfile $businessProfile)
    {
        $this->businessProfile = $businessProfile;
    }

    public function render()
    {
        return view('livewire.business-profile.create');
    }

    public function submit()
    {
        $this->validate();

        $this->businessProfile->save();

        $brand = Branding::where('owner_id', auth()->id())->first();
        if(empty($brand)){
            Branding::create([
                'title'  => 'Branding for - ' . $this->businessProfile->business_name,
                'footer' => 'Contact us for any further question - Phone - ' . $this->businessProfile->phone . ' Email - ' . $this->businessProfile->email,
                'header' => $this->businessProfile->business_name . ' - Phone - ' . $this->businessProfile->phone . ' Email - ' . $this->businessProfile->email,
            ]);
        }

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
