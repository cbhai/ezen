@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.workitem.title_singular') }}:
                    {{ trans('cruds.workitem.fields.id') }}
                    {{ $workitem->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.id') }}
                            </th>
                            <td>
                                {{ $workitem->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.room') }}
                            </th>
                            <td>
                                @if($workitem->room)
                                    <span class="badge badge-relationship">{{ $workitem->room->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.name') }}
                            </th>
                            <td>
                                {{ $workitem->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.description') }}
                            </th>
                            <td>
                                {{ $workitem->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.rate') }}
                            </th>
                            <td>
                                {{ $workitem->rate }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.unit') }}
                            </th>
                            <td>
                                {{ $workitem->unit_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.workitem.fields.owner') }}
                            </th>
                            <td>
                                @if($workitem->owner)
                                    <span class="badge badge-relationship">{{ $workitem->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('workitem_edit')
                    <a href="{{ route('admin.workitems.edit', $workitem) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.workitems.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection