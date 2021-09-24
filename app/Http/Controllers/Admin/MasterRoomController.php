<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterRoom;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MasterRoomController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('master_room_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-room.index');
    }

    public function create()
    {
        abort_if(Gate::denies('master_room_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-room.create');
    }

    public function edit(MasterRoom $masterRoom)
    {
        abort_if(Gate::denies('master_room_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-room.edit', compact('masterRoom'));
    }

    public function show(MasterRoom $masterRoom)
    {
        abort_if(Gate::denies('master_room_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.master-room.show', compact('masterRoom'));
    }
}
