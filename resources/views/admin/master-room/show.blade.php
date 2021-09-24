@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.masterRoom.title_singular') }}:
                    {{ trans('cruds.masterRoom.fields.id') }}
                    {{ $masterRoom->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.masterRoom.fields.id') }}
                            </th>
                            <td>
                                {{ $masterRoom->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterRoom.fields.name') }}
                            </th>
                            <td>
                                {{ $masterRoom->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterRoom.fields.description') }}
                            </th>
                            <td>
                                {{ $masterRoom->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterRoom.fields.created_at') }}
                            </th>
                            <td>
                                {{ $masterRoom->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterRoom.fields.updated_at') }}
                            </th>
                            <td>
                                {{ $masterRoom->updated_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterRoom.fields.deleted_at') }}
                            </th>
                            <td>
                                {{ $masterRoom->deleted_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('master_room_edit')
                    <a href="{{ route('admin.master-rooms.edit', $masterRoom) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.master-rooms.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection