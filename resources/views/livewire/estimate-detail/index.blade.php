<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('estimate_detail_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="EstimateDetail" format="csv" />
                <livewire:excel-export model="EstimateDetail" format="xlsx" />
                <livewire:excel-export model="EstimateDetail" format="pdf" />
            @endif




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
                            {{ trans('cruds.estimateDetail.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.estimate') }}
                            @include('components.table.sort', ['field' => 'estimate.title'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.room') }}
                            @include('components.table.sort', ['field' => 'room.name'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.description') }}
                            @include('components.table.sort', ['field' => 'description'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.rate') }}
                            @include('components.table.sort', ['field' => 'rate'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.unit') }}
                            @include('components.table.sort', ['field' => 'unit'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.quantity') }}
                            @include('components.table.sort', ['field' => 'quantity'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.total') }}
                            @include('components.table.sort', ['field' => 'total'])
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($estimateDetails as $estimateDetail)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $estimateDetail->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $estimateDetail->id }}
                            </td>
                            <td>
                                @if($estimateDetail->estimate)
                                    <span class="badge badge-relationship">{{ $estimateDetail->estimate->title ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($estimateDetail->room)
                                    <span class="badge badge-relationship">{{ $estimateDetail->room->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $estimateDetail->name }}
                            </td>
                            <td>
                                {{ $estimateDetail->description }}
                            </td>
                            <td>
                                {{ $estimateDetail->rate }}
                            </td>
                            <td>
                                {{ $estimateDetail->unit_label }}
                            </td>
                            <td>
                                {{ $estimateDetail->quantity }}
                            </td>
                            <td>
                                {{ $estimateDetail->total }}
                            </td>
                            <td>
                                @if($estimateDetail->owner)
                                    <span class="badge badge-relationship">{{ $estimateDetail->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('estimate_detail_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.estimate-details.show', $estimateDetail) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('estimate_detail_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.estimate-details.edit', $estimateDetail) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('estimate_detail_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $estimateDetail->id }})" wire:loading.attr="disabled">
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
            {{ $estimateDetails->links() }}
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