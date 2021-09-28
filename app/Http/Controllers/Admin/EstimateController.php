<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\Estimate;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EstimateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estimate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estimate.index');
    }

    public function create($id=null)
    {
        //dd($id);
        abort_if(Gate::denies('estimate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //For first time user only
        if(empty($id)){
            $businessProfile = BusinessProfile::where('owner_id', auth()->id())->first();
            if(empty($businessProfile)){
                return redirect()->route('admin.business-profiles.create');
            }
        }
        return view('admin.estimate.create', ['id' => $id]);
    }

    public function edit(Estimate $estimate)
    {
        abort_if(Gate::denies('estimate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estimate.create', ['id' => $estimate->id]);
        //return view('admin.estimate.edit', compact('estimate'));
    }

    public function show(Estimate $estimate)
    {
        abort_if(Gate::denies('estimate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimate->load('customer', 'owner');

        return view('admin.estimate.show', compact('estimate'));
    }
}
