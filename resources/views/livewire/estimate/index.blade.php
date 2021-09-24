<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="w-full form-select sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('estimate_delete')
                <button class="ml-3 btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Estimate" format="csv" />
                <livewire:excel-export model="Estimate" format="xlsx" />
                <livewire:excel-export model="Estimate" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="inline-block w-full sm:w-1/3" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full table-index">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        @can('user_access')
                        <th class="w-28">
                            {{ trans('cruds.estimate.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        @endcan
                        <th>
                            {{ trans('cruds.estimate.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.estimate.fields.customer') }}
                            @include('components.table.sort', ['field' => 'customer.first_name'])
                        </th>
                        <th>
                            {{ trans('cruds.estimate.fields.date') }}
                            @include('components.table.sort', ['field' => 'date'])
                        </th>
                        <th>
                            {{ trans('cruds.estimate.fields.total') }}
                            @include('components.table.sort', ['field' => 'total'])
                        </th>
                        @can('user_access')
                        <th>
                            {{ trans('cruds.estimate.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        @endcan
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estimates as $estimate)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $estimate->id }}" wire:model="selected">
                            </td>
                            @can('user_access')
                            <td>
                                {{ $estimate->id }}
                            </td>
                            @endcan
                            <td>
                                {{ $estimate->title }}
                            </td>
                            <td>
                                @if($estimate->customer)
                                    <span class="badge badge-relationship">{{ $estimate->customer->first_name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $estimate->date }}
                            </td>
                            <td>
                                {{ $estimate->total }}
                            </td>
                            @can('user_access')
                            <td>
                                @if($estimate->owner)
                                    <span class="badge badge-relationship">{{ $estimate->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            @endcan
                            <td>
                                <div class="flex justify-end">
                                    @can('estimate_show')
                                        <a class="mr-2 btn btn-sm btn-info" href="{{ route('admin.estimates.show', $estimate) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('estimate_edit')
                                        <a class="mr-2 btn btn-sm btn-success" href="{{ route('admin.estimates.edit', $estimate) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('estimate_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="confirm('delete', {{ $estimate->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $estimates->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush
