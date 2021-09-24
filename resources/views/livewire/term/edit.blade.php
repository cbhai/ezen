<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('term.terms') ? 'invalid' : '' }}">
        <label class="form-label required" for="terms">{{ trans('cruds.term.fields.terms') }}</label>
        <textarea class="form-control" name="terms" id="terms" required wire:model.defer="term.terms" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('term.terms') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.term.fields.terms_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.terms.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>