<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="w-full form-select sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('workitem_delete')
                <button class="ml-3 btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Workitem" format="csv" />
                <livewire:excel-export model="Workitem" format="xlsx" />
                <livewire:excel-export model="Workitem" format="pdf" />
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
                            {{ trans('cruds.workitem.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        @endcan
                        <th>
                            {{ trans('cruds.workitem.fields.room') }}
                            @include('components.table.sort', ['field' => 'room.name'])
                        </th>
                        <th>
                            {{ trans('cruds.workitem.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.workitem.fields.rate') }}
                            @include('components.table.sort', ['field' => 'rate'])
                        </th>
                        <th>
                            {{ trans('cruds.workitem.fields.unit') }}
                            @include('components.table.sort', ['field' => 'unit'])
                        </th>
                        @can('user_access')
                        <th>
                            {{ trans('cruds.workitem.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        @endcan
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($workitems as $workitem)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $workitem->id }}" wire:model="selected">
                            </td>
                            @can('user_access')
                            <td>
                                {{ $workitem->id }}
                            </td>
                            @endcan
                            <td>
                                @if($workitem->room)
                                    <span class="badge badge-relationship">{{ $workitem->room->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $workitem->name }}
                            </td>
                            <td>
                                {{ $workitem->rate }}
                            </td>
                            <td>
                                {{ $workitem->unit_label }}
                            </td>
                            @can('user_access')
                            <td>
                                @if($workitem->owner)
                                    <span class="badge badge-relationship">{{ $workitem->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            @endcan
                            <td>
                                <div class="flex justify-end">
                                    @can('workitem_show')
                                        <a class="mr-2 btn btn-sm btn-info" href="{{ route('admin.workitems.show', $workitem) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('workitem_edit')
                                        <a class="mr-2 btn btn-sm btn-success" href="{{ route('admin.workitems.edit', $workitem) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('workitem_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="confirm('delete', {{ $workitem->id }})" wire:loading.attr="disabled">
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
            {{ $workitems->links() }}
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
