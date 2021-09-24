@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.masterWorkitem.title_singular') }}:
                    {{ trans('cruds.masterWorkitem.fields.id') }}
                    {{ $masterWorkitem->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.masterWorkitem.fields.id') }}
                            </th>
                            <td>
                                {{ $masterWorkitem->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterWorkitem.fields.room') }}
                            </th>
                            <td>
                                @if($masterWorkitem->room)
                                    <span class="badge badge-relationship">{{ $masterWorkitem->room->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterWorkitem.fields.name') }}
                            </th>
                            <td>
                                {{ $masterWorkitem->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterWorkitem.fields.description') }}
                            </th>
                            <td>
                                {{ $masterWorkitem->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterWorkitem.fields.unit') }}
                            </th>
                            <td>
                                {{ $masterWorkitem->unit_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.masterWorkitem.fields.rate') }}
                            </th>
                            <td>
                                {{ $masterWorkitem->rate }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('master_workitem_edit')
                    <a href="{{ route('admin.master-workitems.edit', $masterWorkitem) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.master-workitems.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection