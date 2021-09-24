@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.businessProfile.title_singular') }}:
                    {{ trans('cruds.businessProfile.fields.id') }}
                    {{ $businessProfile->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('business-profile.edit', [$businessProfile])
        </div>
    </div>
</div>
@endsection