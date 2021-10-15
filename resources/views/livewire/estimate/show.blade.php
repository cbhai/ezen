<div>
    {{-- <div class="card-controls sm:flex">
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

            @can('user_access')
            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Estimate" format="csv" />
                <livewire:excel-export model="Estimate" format="xlsx" />
                <livewire:excel-export model="Estimate" format="pdf" />
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
                                    @can('estimate_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="duplicate({{ $estimate->id }})" wire:loading.attr="disabled">
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
            {{ $estimates->links() }}
        </div>
    </div> --}}

    <div class="card-body">
        <div class="pt-3">
            <table class="table table-view">
                <tbody class="bg-white">
                    @can('user_access')
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.id') }}
                        </th>
                        <td>
                            {{ $estimate->id }}
                        </td>
                    </tr>
                    @endcan
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.title') }}
                        </th>
                        <td>
                            {{ $estimate->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.customer') }}
                        </th>
                        <td>
                            @if($estimate->customer)
                                <span class="badge badge-relationship">{{ $estimate->customer->fullname() ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.date') }}
                        </th>
                        <td>
                            {{ $estimate->date }}
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    {{-- Add Room starts here --}}

    <div class="overflow-hidden">
        {{-- <div class="card-body"> --}}
        {{-- <div class="overflow-x-auto"> --}}
            <div class="pt-5">
            <table class="table w-full table-index" id="room_table">
                <thead>
                    <tr><th>Room Name</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tableArray as $key => $room)
                        @if (!empty($room) )
                        <tr>
                            <td>
                                {{$room['roomName']}}
                            </td>
                            <td>
                                {{$room['roomTotal']}}
                            </td>
                        </tr>
                        @endif

                        @empty
                        <tr>No Rooms added yet. Add Rooms</tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Add Room starts here --}}

    <div class="pt-3">
        <table class="table table-view">
            <tbody class="bg-white">

                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.terms') }}
                        </th>
                        <td>
                            {!! $estimate->terms !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.header') }}
                        </th>
                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $estimate->header ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.footer') }}
                        </th>

                        <td>
                            <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $estimate->footer ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.total') }}
                        </th>
                        <td>
                            {{ $estimate->total }}
                        </td>
                    </tr>
                    @can('user_access')
                    <tr>
                        <th>
                            {{ trans('cruds.estimate.fields.owner') }}
                        </th>
                        <td>
                            @if($estimate->owner)
                                <span class="badge badge-relationship">{{ $estimate->owner->name ?? '' }}</span>
                            @endif
                        </td>
                    </tr>
                    @endcan
                </tbody>
            </table>
        </div>
        <div class="form-group">
            @can('estimate_edit')
                <button class="mr-2 btn btn-bg btn-success" type="button"
                wire:click.prevent="print">Print</button>
                <a href="{{ route('admin.estimates.edit', $estimate) }}" class="mr-2 btn btn-indigo">
                    {{ trans('global.edit') }}
                </a>
            @endcan
            <a href="{{ route('admin.estimates.index') }}" class="btn btn-secondary">
                {{ trans('global.back') }}
            </a>
        </div>
    </div>

    @foreach ($tableArray as $key => $room)
    <div class="card-body">
        <div class="pt-5">
            <table class="table table-view">
                <tbody class="bg-white">
                    <tr>
                        <th>
                            {{ trans('cruds.room.title_singular') }}
                            {{ trans('cruds.room.fields.name') }}
                        </th>
                        <td>
                            {{ $room['roomName']}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
        {{-- Start of Room - {{$room['room_id']}} --}}
        <div class="overflow-hidden">
            <div class="overflow-x-auto">

        <table class="table w-full border-solid table-index">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.estimateDetail.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.estimateDetail.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.estimateDetail.fields.rate') }}
                    </th>
                    <th>
                        Unit
                    </th>
                    <th>
                        {{ trans('cruds.estimateDetail.fields.quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.estimateDetail.fields.total') }}
                    </th>
                    <th>
                    </th>
                </tr>
            </thead>
            <tbody>

        @foreach ($arrEstimateDetails as $item)
            @if ($tableArrayRoomID[$key] == $item['room_id'])
                <tr>
                    <td>
                        <tr>
                            <td>
                                {{ $item['name'] }}
                            </td>
                            <td>
                                {{ $item['description'] }}
                            </td>
                            <td>
                                {{ $item['rate'] }}
                            </td>
                            <td>
                                {{ $item['unit'] }}
                            </td>
                            <td>
                                {{ $item['quantity'] }}
                            </td>
                            <td>
                                {{$item['total']}}
                            </td>
                        </tr>
                    </td>
                </tr>
            @endif
        @endforeach
                <tr>
                    <td class="justified-left">
                        <strong><h2>Room Total is : Rs {{$room['roomTotal']}}</h2></strong>
                    </td>
                </tr>
        </tbody>
    </table>
    </div></div>
    @endforeach
    {{--
        @foreach ($collection as $item)

        <div class="overflow-hidden">
            <div class="overflow-x-auto ">
                <table class="table w-full border-solid table-index">
                    <thead>
                        <tr>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.rate') }}
                            </th>
                            <th>
                                Unit
                            </th>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.quantity') }}
                            </th>
                            <th>
                                {{ trans('cruds.estimateDetail.fields.total') }}
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrEstimateDetails as $item)
                        <tr>
                            <td>
                                {{ $item['name'] }}
                            </td>
                            <td>
                                {{ $item['description'] }}
                            </td>
                            <td>
                                {{ $item['rate'] }}
                            </td>
                            <td>
                                {{ $item['unit'] }}
                            </td>
                            <td>
                                {{ $item['quantity'] }}
                            </td>
                            <td>
                                {{$item['total']}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach --}}


</div>
