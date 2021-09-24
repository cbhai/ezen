@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.term.title_singular') }}:
                    {{ trans('cruds.term.fields.id') }}
                    {{ $term->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('term.edit', [$term])
        </div>
    </div>
</div>
@endsection