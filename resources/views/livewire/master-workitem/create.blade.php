<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('masterWorkitem.room_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="room">{{ trans('cruds.masterWorkitem.fields.room') }}</label>
        <x-select-list class="form-control" required id="room" name="room" :options="$this->listsForFields['room']" wire:model="masterWorkitem.room_id" />
        <div class="validation-message">
            {{ $errors->first('masterWorkitem.room_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.masterWorkitem.fields.room_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('masterWorkitem.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.masterWorkitem.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="masterWorkitem.name">
        <div class="validation-message">
            {{ $errors->first('masterWorkitem.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.masterWorkitem.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('masterWorkitem.description') ? 'invalid' : '' }}">
        <label class="form-label required" for="description">{{ trans('cruds.masterWorkitem.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" required wire:model.defer="masterWorkitem.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('masterWorkitem.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.masterWorkitem.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('masterWorkitem.unit') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.masterWorkitem.fields.unit') }}</label>
        <select class="form-control" wire:model="masterWorkitem.unit">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['unit'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('masterWorkitem.unit') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.masterWorkitem.fields.unit_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('masterWorkitem.rate') ? 'invalid' : '' }}">
        <label class="form-label required" for="rate">{{ trans('cruds.masterWorkitem.fields.rate') }}</label>
        <input class="form-control" type="number" name="rate" id="rate" required wire:model.defer="masterWorkitem.rate" step="0.01">
        <div class="validation-message">
            {{ $errors->first('masterWorkitem.rate') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.masterWorkitem.fields.rate_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.master-workitems.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>