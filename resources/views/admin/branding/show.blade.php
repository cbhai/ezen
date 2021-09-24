@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{-- {{ trans('global.view') }} --}}
                    {{ trans('cruds.branding.title_singular') }}:
                    {{-- {{ trans('cruds.branding.fields.id') }} --}}
                    {{ $branding->title }}
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
                                {{ trans('cruds.branding.fields.id') }}
                            </th>
                            <td>
                                {{ $branding->id }}
                            </td>
                        </tr>
                        @endcan
                        <tr>
                            <th>
                                {{ trans('cruds.branding.fields.title') }}
                            </th>
                            <td>
                                {{ $branding->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branding.fields.header') }}
                            </th>
                            <td>
                                {{ $branding->header }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branding.fields.footer') }}
                            </th>
                            <td>
                                {{ $branding->footer }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.branding.fields.logo') }}
                            </th>
                            <td>
                                @foreach($branding->logo as $key => $entry)
                                    <a class="link-photo" href="{{ $entry['url'] }}">
                                        <img src="{{ $entry['preview_thumbnail'] }}" alt="{{ $entry['name'] }}" title="{{ $entry['name'] }}">
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        @can('user_access')
                        <tr>
                            <th>
                                {{ trans('cruds.branding.fields.owner') }}
                            </th>
                            <td>
                                @if($branding->owner)
                                    <span class="badge badge-relationship">{{ $branding->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        @endcan
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('branding_edit')
                    <a href="{{ route('admin.brandings.edit', $branding) }}" class="mr-2 btn btn-indigo">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.brandings.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
