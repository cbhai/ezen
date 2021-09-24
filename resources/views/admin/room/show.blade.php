@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.room.title_singular') }}:
                    {{ trans('cruds.room.fields.name') }}
                    {{ $room->name }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        @can('user_access')
                            <tr>
                                <th>
                                    {{ trans('cruds.room.fields.id') }}
                                </th>
                                <td>
                                    {{ $room->id }}
                                </td>
                            </tr>
                        @endcan
                        <tr>
                            <th>
                                {{ trans('cruds.room.fields.name') }}
                            </th>
                            <td>
                                {{ $room->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.room.fields.description') }}
                            </th>
                            <td>
                                {{ $room->description }}
                            </td>
                        </tr>
                        @can('user_access')
                            <tr>
                                <th>
                                    {{ trans('cruds.room.fields.owner') }}
                                </th>
                                <td>
                                    @if($room->owner)
                                        <span class="badge badge-relationship">{{ $room->owner->name ?? '' }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endcan
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('room_edit')
                    <a href="{{ route('admin.rooms.edit', $room) }}" class="mr-2 btn btn-indigo">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
