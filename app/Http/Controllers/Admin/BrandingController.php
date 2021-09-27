<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branding;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BrandingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('branding_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branding = Branding::where('owner_id', auth()->id())->first();

        if(empty($branding)){
            return view('admin.branding.create');
        }else{
            $branding->load('owner');
            return view('admin.branding.show', compact('branding'));
        }

        //return view('admin.branding.index');
    }

    public function create()
    {
        abort_if(Gate::denies('branding_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.branding.create');
    }

    public function edit(Branding $branding)
    {
        abort_if(Gate::denies('branding_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.branding.edit', compact('branding'));
    }

    public function show(Branding $branding)
    {
        abort_if(Gate::denies('branding_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $branding->load('owner');

        return view('admin.branding.show', compact('branding'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['branding_create', 'branding_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }
        if (request()->has('max_width') || request()->has('max_height')) {
            $this->validate(request(), [
                'file' => sprintf(
                'image|dimensions:max_width=%s,max_height=%s',
                request()->input('max_width', 100000),
                request()->input('max_height', 100000)
                ),
            ]);
        }

        $model                     = new Branding();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }
}
