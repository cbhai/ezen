<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="w-full form-select sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('branding_delete')
                <button class="ml-3 btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @can('user_access')
            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Branding" format="csv" />
                <livewire:excel-export model="Branding" format="xlsx" />
                <livewire:excel-export model="Branding" format="pdf" />
            @endif
            @endcan



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
                        @can('user_access')
                        <th class="w-9">
                        </th>
                        @endcan
                        @can('user_access')
                        <th class="w-28">
                            {{ trans('cruds.branding.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        @endcan
                        <th>
                            {{ trans('cruds.branding.fields.title') }}
                            @include('components.table.sort', ['field' => 'title'])
                        </th>
                        <th>
                            {{ trans('cruds.branding.fields.header') }}
                            @include('components.table.sort', ['field' => 'hedaer'])
                        </th>
                        @can('user_access')
                        <th>
                            {{ trans('cruds.branding.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        @endcan
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brandings as $branding)
                        <tr>
                            @can('user_access')
                            <td>
                                <input type="checkbox" value="{{ $branding->id }}" wire:model="selected">
                            </td>
                            @endcan
                            @can('user_access')
                            <td>
                                {{ $branding->id }}
                            </td>
                            @endcan
                            <td>
                                {{ $branding->title }}
                            </td>
                            <td>
                                {{ $branding->header }}
                            </td>
                            @can('user_access')
                            <td>
                                @if($branding->owner)
                                    <span class="badge badge-relationship">{{ $branding->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            @endcan
                            <td>
                                <div class="flex justify-end">
                                    @can('branding_show')
                                        <a class="mr-2 btn btn-sm btn-info" href="{{ route('admin.brandings.show', $branding) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('branding_edit')
                                        <a class="mr-2 btn btn-sm btn-success" href="{{ route('admin.brandings.edit', $branding) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('user_access')
                                    @can('branding_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="confirm('delete', {{ $branding->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
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
            {{ $brandings->links() }}
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
