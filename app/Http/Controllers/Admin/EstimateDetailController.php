<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstimateDetail;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EstimateDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estimate_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estimate-detail.index');
    }

    public function create($estimate_id = null)
    {
        //dd($estimate_id);
        abort_if(Gate::denies('estimate_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estimate-detail.create', ['estimate_id' => $estimate_id]);
    }

    public function edit(EstimateDetail $estimateDetail)
    {
        abort_if(Gate::denies('estimate_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.estimate-detail.edit', compact('estimateDetail'));
    }

    public function show(EstimateDetail $estimateDetail)
    {
        abort_if(Gate::denies('estimate_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estimateDetail->load('estimate', 'room', 'owner');

        return view('admin.estimate-detail.show', compact('estimateDetail'));
    }
}
