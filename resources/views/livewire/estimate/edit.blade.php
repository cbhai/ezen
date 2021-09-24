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
    <div class="form-group {{ $errors->has('estimate.customer_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="customer">{{ trans('cruds.estimate.fields.customer') }}</label>
        <x-select-list class="form-control" required id="customer" name="customer" :options="$this->listsForFields['customer']" wire:model="estimate.customer_id" />
        <div class="validation-message">
            {{ $errors->first('estimate.customer_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimate.fields.customer_helper') }}
        </div>
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
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.estimates.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>