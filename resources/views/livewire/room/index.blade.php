<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="w-full form-select sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('room_delete')
                <button class="ml-3 btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @can('user_access')
                @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                    <livewire:excel-export model="Room" format="csv" />
                    <livewire:excel-export model="Room" format="xlsx" />
                    <livewire:excel-export model="Room" format="pdf" />
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
                        <th class="w-9">
                        </th>
                        @can('user_access')
                            <th class="w-28">
                                {{ trans('cruds.room.fields.id') }}
                                @include('components.table.sort', ['field' => 'id'])
                            </th>
                        @endcan
                        <th>
                            {{ trans('cruds.room.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.room.fields.name') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        @can('user_access')
                            <th>
                                {{ trans('cruds.room.fields.owner') }}
                                @include('components.table.sort', ['field' => 'owner.name'])
                            </th>
                        @endcan
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $room->id }}" wire:model="selected">
                            </td>
                            @can('user_access')
                                <td>
                                    {{ $room->id }}
                                </td>
                            @endcan
                            <td>
                                {{ $room->name }}
                            </td>
                            <td>
                                {{ $room->description }}
                            </td>
                            @can('user_access')
                                <td>
                                    @if($room->owner)
                                        <span class="badge badge-relationship">{{ $room->owner->name ?? '' }}</span>
                                    @endif
                                </td>
                            @endcan
                            <td>
                                <div class="flex justify-end">
                                    @can('room_show')
                                        <a class="mr-2 btn btn-sm btn-info" href="{{ route('admin.rooms.show', $room) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('room_edit')
                                        <a class="mr-2 btn btn-sm btn-success" href="{{ route('admin.rooms.edit', $room) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('room_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="confirm('delete', {{ $room->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                    @can('room_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="duplicate({{ $room->id }})" wire:loading.attr="disabled">
                                            Duplicate
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
            {{ $rooms->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSureRoom') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush
