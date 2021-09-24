<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('master_workitem_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="MasterWorkitem" format="csv" />
                <livewire:excel-export model="MasterWorkitem" format="xlsx" />
                <livewire:excel-export model="MasterWorkitem" format="pdf" />
            @endif


            @can('master_workitem_create')
                <x-csv-import route="{{ route('admin.master-workitems.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.masterWorkitem.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.masterWorkitem.fields.room') }}
                            @include('components.table.sort', ['field' => 'room.name'])
                        </th>
                        <th>
                            {{ trans('cruds.masterWorkitem.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.masterWorkitem.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                            {{ trans('cruds.masterWorkitem.fields.unit') }}
                            @include('components.table.sort', ['field' => 'unit'])
                        </th>
                        <th>
                            {{ trans('cruds.masterWorkitem.fields.rate') }}
                            @include('components.table.sort', ['field' => 'rate'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($masterWorkitems as $masterWorkitem)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $masterWorkitem->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $masterWorkitem->id }}
                            </td>
                            <td>
                                @if($masterWorkitem->room)
                                    <span class="badge badge-relationship">{{ $masterWorkitem->room->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $masterWorkitem->name }}
                            </td>
                            <td>
                                {{ $masterWorkitem->description }}
                            </td>
                            <td>
                                {{ $masterWorkitem->unit_label }}
                            </td>
                            <td>
                                {{ $masterWorkitem->rate }}
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('master_workitem_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.master-workitems.show', $masterWorkitem) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('master_workitem_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.master-workitems.edit', $masterWorkitem) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('master_workitem_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $masterWorkitem->id }})" wire:loading.attr="disabled">
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
            {{ $masterWorkitems->links() }}
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