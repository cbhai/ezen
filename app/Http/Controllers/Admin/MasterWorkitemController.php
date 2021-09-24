<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\MasterWorkitem;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MasterWorkitemController extends Controller
{
    use WithCSVImport;

    public function __construct()
    {
        $this->csvImportModel = MasterWorkitem::class;
    }

    public function index()
    {
        abort_if(Gate::denies('master_workitem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-workitem.index');
    }

    public function create()
    {
        abort_if(Gate::denies('master_workitem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-workitem.create');
    }

    public function edit(MasterWorkitem $masterWorkitem)
    {
        abort_if(Gate::denies('master_workitem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-workitem.edit', compact('masterWorkitem'));
    }

    public function show(MasterWorkitem $masterWorkitem)
    {
        abort_if(Gate::denies('master_workitem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $masterWorkitem->load('room');

        return view('admin.master-workitem.show', compact('masterWorkitem'));
    }
}
