@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.masterWorkitem.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('master_workitem_create')
                    <a class="btn btn-indigo" href="{{ route('admin.master-workitems.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.masterWorkitem.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('master-workitem.index')

    </div>
</div>
@endsection