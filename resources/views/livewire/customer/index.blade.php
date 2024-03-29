<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="w-full form-select sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('customer_delete')
                <button class="ml-3 btn btn-rose disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @can('user_access')
            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Customer" format="csv" />
                <livewire:excel-export model="Customer" format="xlsx" />
                <livewire:excel-export model="Customer" format="pdf" />
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
                            {{ trans('cruds.customer.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        @endcan
                        <th>
                            {{ trans('cruds.customer.fields.first_name') }}
                            @include('components.table.sort', ['field' => 'first_name'])
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.last_name') }}
                            @include('components.table.sort', ['field' => 'last_name'])
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.email') }}
                            @include('components.table.sort', ['field' => 'email'])
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.phone') }}
                            @include('components.table.sort', ['field' => 'phone'])
                        </th>
                        <th>
                            {{ trans('cruds.customer.fields.city') }}
                            @include('components.table.sort', ['field' => 'city'])
                        </th>
                        @can('user_access')
                        <th>
                            {{ trans('cruds.customer.fields.owner') }}
                            @include('components.table.sort', ['field' => 'owner.name'])
                        </th>
                        @endcan
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $customer->id }}" wire:model="selected">
                            </td>
                            @can('user_access')
                            <td>
                                {{ $customer->id }}
                            </td>
                            @endcan
                            <td>
                                {{ $customer->first_name }}
                            </td>
                            <td>
                                {{ $customer->last_name }}
                            </td>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $customer->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $customer->email }}
                                </a>
                            </td>
                            <td>
                                {{ $customer->phone }}
                            </td>
                            <td>
                                {{ $customer->city }}
                            </td>
                            @can('user_access')
                            <td>
                                @if($customer->owner)
                                    <span class="badge badge-relationship">{{ $customer->owner->name ?? '' }}</span>
                                @endif
                            </td>
                            @endcan
                            <td>
                                <div class="flex justify-end">
                                    @can('customer_show')
                                        <a class="mr-2 btn btn-sm btn-info" href="{{ route('admin.customers.show', $customer) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('customer_edit')
                                        <a class="mr-2 btn btn-sm btn-success" href="{{ route('admin.customers.edit', $customer) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('customer_delete')
                                        <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="confirm('delete', {{ $customer->id }})" wire:loading.attr="disabled">
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
            {{ $customers->links() }}
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
