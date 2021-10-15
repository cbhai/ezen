<form wire:submit.prevent="submit" class="pt-3">
    <div class="flex flex-wrap pt-4">
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('customer.first_name') ? 'invalid' : '' }}">
                <label class="form-label required" for="first_name">{{ trans('cruds.customer.fields.first_name') }}</label>
                <input class="form-control" type="text" name="first_name" id="first_name" required wire:model.defer="customer.first_name">
                <div class="validation-message">
                    {{ $errors->first('customer.first_name') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.customer.fields.first_name_helper') }}
                </div>
            </div>
	    </div>
	    <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('customer.last_name') ? 'invalid' : '' }}">
                <label class="form-label required" for="last_name">{{ trans('cruds.customer.fields.last_name') }}</label>
                <input class="form-control" type="text" name="last_name" id="last_name" required wire:model.defer="customer.last_name">
                <div class="validation-message">
                    {{ $errors->first('customer.last_name') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.customer.fields.last_name_helper') }}
                </div>
            </div>
	    </div>
    </div>
    <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pr-4 form-group {{ $errors->has('customer.status') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.customer.fields.status') }}</label>
        <select class="form-control" wire:model="customer.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('customer.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.customer.fields.status_helper') }}
        </div>
    </div>
    <div class="flex flex-wrap pt-4">
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('customer.email') ? 'invalid' : '' }}">
                <label class="form-label required" for="email">{{ trans('cruds.customer.fields.email') }}</label>
                <input class="form-control" type="email" name="email" id="email" required wire:model.defer="customer.email">
                <div class="validation-message">
                    {{ $errors->first('customer.email') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.customer.fields.email_helper') }}
                </div>
            </div>
	    </div>
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('customer.phone') ? 'invalid' : '' }}">
                <label class="form-label required" for="phone">{{ trans('cruds.customer.fields.phone') }}</label>
                <input class="form-control" type="text" name="phone" id="phone" required wire:model.defer="customer.phone">
                <div class="validation-message">
                    {{ $errors->first('customer.phone') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.customer.fields.phone_helper') }}
                </div>
            </div>
        </div>
    </div>
    <div class="form-group {{ $errors->has('customer.address') ? 'invalid' : '' }}">
        <label class="form-label" for="address">{{ trans('cruds.customer.fields.address') }}</label>
        <input class="form-control" type="text" name="address" id="address" wire:model.defer="customer.address">
        <div class="validation-message">
            {{ $errors->first('customer.address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.customer.fields.address_helper') }}
        </div>
    </div>

    <div class="flex flex-wrap pt-4">
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
		    <div class="form-group {{ $errors->has('customer.city') ? 'invalid' : '' }}">
                <label class="form-label required" for="city">{{ trans('cruds.customer.fields.city') }}</label>
                <input class="form-control" type="text" name="city" id="city" required wire:model.defer="customer.city">
                <div class="validation-message">
                    {{ $errors->first('customer.city') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.customer.fields.city_helper') }}
                </div>
            </div>
        </div>
        <div class="w-full pr-4 mb-4 md:w-1/2 lg:w-1/2 xl:w-1/2">
            <div class="form-group {{ $errors->has('customer.state') ? 'invalid' : '' }}">
                <label class="form-label required" for="state">{{ trans('cruds.customer.fields.state') }}</label>
                <input class="form-control" type="text" name="state" id="state" required wire:model.defer="customer.state">
                <div class="validation-message">
                    {{ $errors->first('customer.state') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.customer.fields.state_helper') }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pr-4 form-group {{ $errors->has('customer.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.customer.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" wire:model.defer="customer.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('customer.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.customer.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group">
        <button class="mr-2 btn btn-indigo" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
