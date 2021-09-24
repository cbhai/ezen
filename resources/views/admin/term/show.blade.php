@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.term.title_singular') }}:
                    {{ trans('cruds.term.fields.id') }}
                    {{ $term->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.term.fields.id') }}
                            </th>
                            <td>
                                {{ $term->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.term.fields.terms') }}
                            </th>
                            <td>
                                {{ $term->terms }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.term.fields.owner') }}
                            </th>
                            <td>
                                @if($term->owner)
                                    <span class="badge badge-relationship">{{ $term->owner->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('term_edit')
                    <a href="{{ route('admin.terms.edit', $term) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection