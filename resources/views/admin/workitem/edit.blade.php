@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.workitem.title_singular') }}:
                    {{ trans('cruds.workitem.fields.id') }}
                    {{ $workitem->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('workitem.edit', [$workitem])
        </div>
    </div>
</div>
@endsection