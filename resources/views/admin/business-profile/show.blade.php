@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.businessProfile.title_singular') }}:
                    {{ trans('cruds.businessProfile.fields.id') }}
                    {{ $businessProfile->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.id') }}
                            </th>
                            <td>
                                {{ $businessProfile->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.business_name') }}
                            </th>
                            <td>
                                {{ $businessProfile->business_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.first_name') }}
                            </th>
                            <td>
                                {{ $businessProfile->first_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.last_name') }}
                            </th>
                            <td>
                                {{ $businessProfile->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.phone') }}
                            </th>
                            <td>
                                {{ $businessProfile->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $businessProfile->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $businessProfile->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.address') }}
                            </th>
                            <td>
                                {{ $businessProfile->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.city') }}
                            </th>
                            <td>
                                {{ $businessProfile->city }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.state') }}
                            </th>
                            <td>
                                {{ $businessProfile->state }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.pin_code') }}
                            </th>
                            <td>
                                {{ $businessProfile->pin_code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.about') }}
                            </th>
                            <td>
                                {{ $businessProfile->about }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.businessProfile.fields.owner') }}
                            </th>
                            <td>
                                @if($businessProfile->owner)
                                    <span class="badge badge-relationship">{{ $businessProfile->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('business_profile_edit')
                    <a href="{{ route('admin.business-profiles.edit', $businessProfile) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.business-profiles.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection