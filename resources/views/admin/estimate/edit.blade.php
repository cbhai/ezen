@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.estimate.title_singular') }}:
                    {{ trans('cruds.estimate.fields.id') }}
                    {{ $estimate->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('estimate.edit', [$estimate])
        </div>
    </div>
</div>
@endsection