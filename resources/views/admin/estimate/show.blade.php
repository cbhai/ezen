@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.estimate.title_singular') }}:
                    {{ trans('cruds.estimate.fields.id') }}
                    {{ $estimate->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.id') }}
                            </th>
                            <td>
                                {{ $estimate->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.title') }}
                            </th>
                            <td>
                                {{ $estimate->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.customer') }}
                            </th>
                            <td>
                                @if($estimate->customer)
                                    <span class="badge badge-relationship">{{ $estimate->customer->first_name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.date') }}
                            </th>
                            <td>
                                {{ $estimate->date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.terms') }}
                            </th>
                            <td>
                                {{ $estimate->terms }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.header') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $estimate->header ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.footer') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $estimate->footer ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.total') }}
                            </th>
                            <td>
                                {{ $estimate->total }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.estimate.fields.owner') }}
                            </th>
                            <td>
                                @if($estimate->owner)
                                    <span class="badge badge-relationship">{{ $estimate->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('estimate_edit')
                    <a href="{{ route('admin.estimates.edit', $estimate) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.estimates.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection