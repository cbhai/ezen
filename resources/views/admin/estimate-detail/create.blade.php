@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.create') }}
                    {{ trans('cruds.estimateDetail.title_singular') }}
                </h6>
            </div>

        <div class="card-body">
            {{-- {{ $estimate_id }} --}}
            @livewire('estimate-detail.create', ['estimate_id' => $estimate_id, 'room_id' => $room_id])
            {{-- @livewire('estimate-detail.create') --}}
        </div>
    </div>
</div>
@endsection
