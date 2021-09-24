<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workitem;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WorkitemController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('workitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workitem.index');
    }

    public function create()
    {
        abort_if(Gate::denies('workitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workitem.create');
    }

    public function edit(Workitem $workitem)
    {
        abort_if(Gate::denies('workitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workitem.edit', compact('workitem'));
    }

    public function show(Workitem $workitem)
    {
        abort_if(Gate::denies('workitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workitem->load('room', 'owner');

        return view('admin.workitem.show', compact('workitem'));
    }
}
