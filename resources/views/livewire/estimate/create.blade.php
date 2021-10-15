<form wire:submit.prevent="submit" class="pt-3">
    <div class="flex flex-wrap pt-4">
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
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
        </div>
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('estimate.title') ? 'invalid' : '' }}">
                <label class="form-label required" for="title">Estimate Title</label>
                <input class="form-control" type="text" name="title" id="title" required wire:model.defer="estimate.title">
                <div class="validation-message">
                    {{ $errors->first('estimate.title') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.estimate.fields.title_helper') }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap pt-4">
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group">
                <label class="form-label required" for="Customer Details">Customer Details : </label>
                {{$this->customer['first_name'] . ' ' . $this->customer['last_name']}}<br>
                {{$this->customer['address']}}<br>
                {{$this->customer['city'] . ' , ' . $this->customer['state'] }}<br>
                {{$this->customer['phone']}}<br>
                {{$this->customer['email']}}<br>
            </div>
        </div>
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
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
        </div>
    </div>

    {{-- Add Room starts here --}}
    <div class="pt-4 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full border table-index" id="room_table">
                <thead>
                    <tr><th><label class="form-label">ROOM NAME</label></th>
                        <th><label class="form-label">SUB TOTAL</label></th>
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
                                    @can('estimate_edit')
                                        <a class="mr-2 btn btn-sm btn-success"
                                            href="{{ route('admin.estimate-details.create',['estimate_id' => $estimate->id, 'room_id' => $room['room_id'] ])}}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('estimate_delete')
                                        <button class="mr-2 btn btn-sm btn-rose"
                                        type="button" wire:click="deleteRoom({{$key}})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @endif

                        @empty
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                            <td colspan="3">
                                <span class="inline-block px-2 py-1 mr-1 text-xs font-semibold text-indigo-600 uppercase bg-indigo-200 rounded last:mr-0">
                                    No Rooms added yet! ADD ROOMS
                                  </span>
                            </td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
    {{-- Add Room ends here --}}
    <div class="pt-8">
        <button class="mr-2 btn btn-bg btn-success" type="button"
            wire:click.prevent="addRoom">Add Room</button>
    </div>
    <div class="pt-8 form-group {{ $errors->has('estimate.terms') ? 'invalid' : '' }}">
        <label class="form-label" for="terms">{{ trans('cruds.estimate.fields.terms') }}</label>
        <textarea class="form-control" name="terms" id="terms" wire:model.defer="estimate_terms" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('estimate.terms') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.terms_helper') }}
        </div>
    </div>

    <div class="flex flex-wrap pt-4">
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('estimate.header') ? 'invalid' : '' }}">
                <label class="form-label" for="header">Show Header in PDF</label>
                <input class="form-control" type="checkbox" name="header" id="header" wire:model.defer="estimate.header">
                <div class="validation-message">
                    {{ $errors->first('estimate.header') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.estimate.fields.header_helper') }}
                </div>
            </div>
        </div>
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('estimate.footer') ? 'invalid' : '' }}">
                <label class="form-label" for="footer">Show Footer in PDF</label>
                <input class="form-control" type="checkbox" name="footer" id="footer" wire:model.defer="estimate.footer">
                <div class="validation-message">
                    {{ $errors->first('estimate.footer') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.estimate.fields.footer_helper') }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pr-4 form-group {{ $errors->has('estimate.total') ? 'invalid' : '' }}">
        <label class="form-label required" for="total">{{ trans('cruds.estimate.fields.total') }}</label>
        <input class="form-control" disabled type="number" name="total" id="total" required wire:model.defer="estimate_total" step="0.01">
        <div class="validation-message">
            {{ $errors->first('estimate.total') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.total_helper') }}
        </div>
    </div>
    <div class="form-group">
        <button class="mr-2 btn btn-bg btn-success" type="button"
        wire:click.prevent="print">Print</button>
        <button class="mr-2 btn btn-bg btn-indigo" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.estimates.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
