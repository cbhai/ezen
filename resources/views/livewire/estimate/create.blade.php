<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('estimate.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.estimate.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" required wire:model.defer="estimate.title">
        <div class="validation-message">
            {{ $errors->first('estimate.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.title_helper') }}
        </div>
    </div>
    {{-- <div class="form-group {{ $errors->has('estimate.customer_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="customer">{{ trans('cruds.estimate.fields.customer') }}</label>
        <x-select-list class="form-control" required id="customer" name="customer" :options="$this->listsForFields['customer']" wire:model="estimate.customer_id" />
        <div class="validation-message">
            {{ $errors->first('estimate.customer_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.customer_helper') }}
        </div>
    </div> --}}

    <div class="form-group {{ $errors->has('estimate.customer_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="customer">{{ trans('cruds.estimate.fields.customer') }}</label>
        <select class="form-control"  wire:model="estimate.customer_id" required id="customer" name="customer">
            <option value="">Select Customer</option>
            @foreach ($allCustomers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->first_name . ' ' . $customer->last_name }} </option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('estimate.customer_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.customer_helper') }}
        </div>
    </div>
    <div class="form-group">
        <label class="form-label required" for="Customer Details">Customer Details : </label>
        {{$this->customer['first_name'] . ' ' . $this->customer['last_name']}}<br>
        {{$this->customer['address']}}<br>
        {{$this->customer['city'] . ' , ' . $this->customer['state'] }}<br>
        {{$this->customer['phone']}}<br>
        {{$this->customer['email']}}<br>
    </div>

    <div class="form-group {{ $errors->has('estimate.date') ? 'invalid' : '' }}">
        <label class="form-label required" for="date">{{ trans('cruds.estimate.fields.date') }}</label>
        <x-date-picker class="form-control" required wire:model="estimate.date" id="date" name="date" picker="date" />
        <div class="validation-message">
            {{ $errors->first('estimate.date') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.date_helper') }}
        </div>
    </div>

    {{-- Add Room starts here --}}
    <div class="overflow-hidden">
        <div class="overflow-x-auto">
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
                            <td>
                                <div class="flex justify-end">
                                    @can('estimate_show')
                                        <a class="mr-2 btn btn-sm btn-info"
                                            href="{{ route('admin.estimates.show', $estimate)}}">
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
                        @endif

                        @empty
                        <tr>No Rooms added yet. Add Rooms</tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>


    {{-- Add Room ends here --}}


    <div>
        <button class="mr-2 btn btn-success" type="button"
            wire:click.prevent="addRoom">Add Room</button>
    </div>




    <div class="form-group {{ $errors->has('estimate.terms') ? 'invalid' : '' }}">
        <label class="form-label" for="terms">{{ trans('cruds.estimate.fields.terms') }}</label>
        <textarea class="form-control" name="terms" id="terms" wire:model.defer="estimate.terms" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('estimate.terms') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.terms_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimate.header') ? 'invalid' : '' }}">
        <label class="form-label" for="header">{{ trans('cruds.estimate.fields.header') }}</label>
        <input class="form-control" type="checkbox" name="header" id="header" wire:model.defer="estimate.header">
        <div class="validation-message">
            {{ $errors->first('estimate.header') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.header_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimate.footer') ? 'invalid' : '' }}">
        <label class="form-label" for="footer">{{ trans('cruds.estimate.fields.footer') }}</label>
        <input class="form-control" type="checkbox" name="footer" id="footer" wire:model.defer="estimate.footer">
        <div class="validation-message">
            {{ $errors->first('estimate.footer') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.footer_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimate.total') ? 'invalid' : '' }}">
        <label class="form-label required" for="total">{{ trans('cruds.estimate.fields.total') }}</label>
        <input class="form-control" type="number" name="total" id="total" required wire:model.defer="estimate.total" step="0.01">
        <div class="validation-message">
            {{ $errors->first('estimate.total') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.total_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="mr-2 btn btn-success" type="button"
        wire:click.prevent="print">Print</button>
        <button class="mr-2 btn btn-indigo" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.estimates.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
