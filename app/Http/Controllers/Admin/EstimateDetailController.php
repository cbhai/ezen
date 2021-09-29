<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estimate;
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

    public function edit(int $estimate_id, int $room_id)
    {
        abort_if(Gate::denies('estimate_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //dd($estimate_id . " - " . $room_id);

        return view('admin.estimate-detail.edit', ['estimate_id' => $estimate_id, 'room_id' => $room_id]);
    }

    public function show(Estimate $estimate, int $room_id)
    {
        abort_if(Gate::denies('estimate_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //Kept pending, confused in route binding implementation
        $estimateDetails = EstimateDetail::where('estimate_id', $estimate->id)
                            ->where('room_id', $room_id) // ->load('estimate', 'room', 'owner');
                            ->with('room')->get();

        return view('admin.estimate-detail.show', compact('estimateDetails', 'estimate', 'room_id'));
    }
}
