@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.customer.title_singular') }}:
                    {{ trans('cruds.customer.fields.id') }}
                    {{ $customer->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.id') }}
                            </th>
                            <td>
                                {{ $customer->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.first_name') }}
                            </th>
                            <td>
                                {{ $customer->first_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.last_name') }}
                            </th>
                            <td>
                                {{ $customer->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.status') }}
                            </th>
                            <td>
                                {{ $customer->status_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $customer->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $customer->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.phone') }}
                            </th>
                            <td>
                                {{ $customer->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.address') }}
                            </th>
                            <td>
                                {{ $customer->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.city') }}
                            </th>
                            <td>
                                {{ $customer->city }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.state') }}
                            </th>
                            <td>
                                {{ $customer->state }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.description') }}
                            </th>
                            <td>
                                {{ $customer->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.customer.fields.owner') }}
                            </th>
                            <td>
                                @if($customer->owner)
                                    <span class="badge badge-relationship">{{ $customer->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('customer_edit')
                    <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection