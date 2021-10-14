<form wire:submit.prevent="submit" class="pt-3">

    <div
        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pr-4 form-group {{ $errors->has('businessProfile.business_name') ? 'invalid' : '' }}">
        <label class="form-label required"
            for="business_name">{{ trans('cruds.businessProfile.fields.business_name') }}</label>
        <input class="form-control" type="text" name="business_name" id="business_name" required
            wire:model.defer="businessProfile.business_name">
        <div class="validation-message">
            {{ $errors->first('businessProfile.business_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.businessProfile.fields.business_name_helper') }}
        </div>
    </div>
    <div class="flex flex-wrap">
        <div class="w-full pr-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
            <div class="form-group {{ $errors->has('businessProfile.first_name') ? 'invalid' : '' }}">
                <label class="form-label required"
                    for="first_name">{{ trans('cruds.businessProfile.fields.first_name') }}</label>
                <input class="form-control" type="text" name="first_name" id="first_name" required
                    wire:model.defer="businessProfile.first_name">
                <div class="validation-message">
                    {{ $errors->first('businessProfile.first_name') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.businessProfile.fields.first_name_helper') }}
                </div>
            </div>
        </div>
        <div class="w-full pr-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
            <div class="form-group {{ $errors->has('businessProfile.last_name') ? 'invalid' : '' }}">
                <label class="form-label required"
                    for="last_name">{{ trans('cruds.businessProfile.fields.last_name') }}</label>
                <input class="form-control" type="text" name="last_name" id="last_name" required
                    wire:model.defer="businessProfile.last_name">
                <div class="validation-message">
                    {{ $errors->first('businessProfile.last_name') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.businessProfile.fields.last_name_helper') }}
                </div>
            </div>
        </div>
    </div>


    <div class="flex flex-wrap">
        <div class="w-full pr-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
            <div class="form-group {{ $errors->has('businessProfile.phone') ? 'invalid' : '' }}">
                <label class="form-label required"
                    for="phone">{{ trans('cruds.businessProfile.fields.phone') }}</label>
                <input class="form-control" type="text" name="phone" id="phone" required
                    wire:model.defer="businessProfile.phone">
                <div class="validation-message">
                    {{ $errors->first('businessProfile.phone') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.businessProfile.fields.phone_helper') }}
                </div>
            </div>
        </div>
        <div class="w-full pr-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
            <div class="form-group {{ $errors->has('businessProfile.email') ? 'invalid' : '' }}">
                <label class="form-label required"
                    for="email">{{ trans('cruds.businessProfile.fields.email') }}</label>
                <input class="form-control" type="email" name="email" id="email" required
                    wire:model.defer="businessProfile.email">
                <div class="validation-message">
                    {{ $errors->first('businessProfile.email') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.businessProfile.fields.email_helper') }}
                </div>
            </div>
        </div>
    </div>
    <div class="pr-4 form-group {{ $errors->has('businessProfile.address') ? 'invalid' : '' }}">
        <label class="form-label required" for="address">{{ trans('cruds.businessProfile.fields.address') }}</label>
        <input class="form-control" type="text" name="address" id="address" required
            wire:model.defer="businessProfile.address">
        <div class="validation-message">
            {{ $errors->first('businessProfile.address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.businessProfile.fields.address_helper') }}
        </div>
    </div>

    <div class="flex flex-wrap">
        <div class="w-full pr-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
            <div class="form-group {{ $errors->has('businessProfile.city') ? 'invalid' : '' }}">
                <label class="form-label required"
                    for="city">{{ trans('cruds.businessProfile.fields.city') }}</label>
                <input class="form-control" type="text" name="city" id="city" required
                    wire:model.defer="businessProfile.city">
                <div class="validation-message">
                    {{ $errors->first('businessProfile.city') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.businessProfile.fields.city_helper') }}
                </div>
            </div>
        </div>
        <div class="w-full pr-4 mb-4 sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
            <div class="form-group {{ $errors->has('businessProfile.state') ? 'invalid' : '' }}">
                <label class="form-label required"
                    for="state">{{ trans('cruds.businessProfile.fields.state') }}</label>
                <input class="form-control" type="text" name="state" id="state" required
                    wire:model.defer="businessProfile.state">
                <div class="validation-message">
                    {{ $errors->first('businessProfile.state') }}
                </div>
                <div class="help-block">
                    {{ trans('cruds.businessProfile.fields.state_helper') }}
                </div>
            </div>
        </div>
    </div>

    <div
        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pr-4 form-group {{ $errors->has('businessProfile.pin_code') ? 'invalid' : '' }}">
        <label class="form-label required"
            for="pin_code">{{ trans('cruds.businessProfile.fields.pin_code') }}</label>
        <input class="form-control" type="text" name="pin_code" id="pin_code" required
            wire:model.defer="businessProfile.pin_code">
        <div class="validation-message">
            {{ $errors->first('businessProfile.pin_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.businessProfile.fields.pin_code_helper') }}
        </div>
    </div>
    <div
        class="w-full sm:w-1/2 md:w-1/2 lg:w-1/2 pr-4 form-group {{ $errors->has('businessProfile.about') ? 'invalid' : '' }}">
        <label class="form-label" for="about">{{ trans('cruds.businessProfile.fields.about') }}</label>
        <textarea class="form-control" name="about" id="about" wire:model.defer="businessProfile.about"
            rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('businessProfile.about') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.businessProfile.fields.about_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="mr-2 btn btn-indigo" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.business-profiles.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
