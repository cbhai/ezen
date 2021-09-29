@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.estimateDetail.title_singular') }}:
                    {{ trans('cruds.estimateDetail.fields.id') }}
                    {{-- {{ $estimateDetail->id }} --}}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('estimate-detail.edit',  ['estimate_id' => $estimate_id, 'room_id' => $room_id])
        </div>
    </div>
</div>
@endsection
