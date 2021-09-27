<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusinessProfileController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_profile_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessProfile = BusinessProfile::where('owner_id', auth()->id())->first();

        if(empty($businessProfile)){
            return view('admin.business-profile.create');
        }else{
            $businessProfile->load('owner');

            return view('admin.business-profile.show', compact('businessProfile'));
        }
        //return view('admin.business-profile.index');
    }

    public function create()
    {
        abort_if(Gate::denies('business_profile_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.business-profile.create');
    }

    public function edit(BusinessProfile $businessProfile)
    {
        abort_if(Gate::denies('business_profile_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.business-profile.edit', compact('businessProfile'));
    }

    public function show(BusinessProfile $businessProfile)
    {
        abort_if(Gate::denies('business_profile_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businessProfile->load('owner');

        return view('admin.business-profile.show', compact('businessProfile'));
    }
}
