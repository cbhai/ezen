@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.estimateDetail.title_singular') }}:
                    {{ trans('cruds.estimateDetail.fields.id') }}
                    {{ $estimateDetail->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.id') }}
                            </th>
                            <td>
                                {{ $estimateDetail->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.estimate') }}
                            </th>
                            <td>
                                @if($estimateDetail->estimate)
                                    <span class="badge badge-relationship">{{ $estimateDetail->estimate->title ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.room') }}
                            </th>
                            <td>
                                @if($estimateDetail->room)
                                    <span class="badge badge-relationship">{{ $estimateDetail->room->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.name') }}
                            </th>
                            <td>
                                {{ $estimateDetail->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.description') }}
                            </th>
                            <td>
                                {{ $estimateDetail->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.rate') }}
                            </th>
                            <td>
                                {{ $estimateDetail->rate }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.unit') }}
                            </th>
                            <td>
                                {{ $estimateDetail->unit_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.quantity') }}
                            </th>
                            <td>
                                {{ $estimateDetail->quantity }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.total') }}
                            </th>
                            <td>
                                {{ $estimateDetail->total }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.owner') }}
                            </th>
                            <td>
                                @if($estimateDetail->owner)
                                    <span class="badge badge-relationship">{{ $estimateDetail->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('estimate_detail_edit')
                    <a href="{{ route('admin.estimate-details.edit', $estimateDetail) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.estimate-details.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection