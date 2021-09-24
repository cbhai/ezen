<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TermController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('term_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.term.index');
    }

    public function create()
    {
        abort_if(Gate::denies('term_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.term.create');
    }

    public function edit(Term $term)
    {
        abort_if(Gate::denies('term_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.term.edit', compact('term'));
    }

    public function show(Term $term)
    {
        abort_if(Gate::denies('term_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $term->load('owner');

        return view('admin.term.show', compact('term'));
    }
}
