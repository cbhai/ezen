<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('branding.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.branding.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" required wire:model.defer="branding.title">
        <div class="validation-message">
            {{ $errors->first('branding.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branding.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branding.header') ? 'invalid' : '' }}">
        <label class="form-label required" for="header">{{ trans('cruds.branding.fields.header') }}</label>
        <input class="form-control" type="text" name="header" id="header" required wire:model.defer="branding.header">
        <div class="validation-message">
            {{ $errors->first('branding.header') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branding.fields.header_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('branding.footer') ? 'invalid' : '' }}">
        <label class="form-label required" for="footer">{{ trans('cruds.branding.fields.footer') }}</label>
        <input class="form-control" type="text" name="footer" id="footer" required wire:model.defer="branding.footer">
        <div class="validation-message">
            {{ $errors->first('branding.footer') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branding.fields.footer_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.branding_logo') ? 'invalid' : '' }}">
        <label class="form-label required" for="logo">{{ trans('cruds.branding.fields.logo') }}</label>
        <x-dropzone id="logo" name="logo" action="{{ route('admin.brandings.storeMedia') }}" collection-name="branding_logo" max-file-size="2" max-width="4096" max-height="4096" max-files="1" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.branding_logo') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.branding.fields.logo_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.brandings.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>