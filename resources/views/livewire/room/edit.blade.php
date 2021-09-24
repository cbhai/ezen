<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('room.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.room.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="room.name">
        <div class="validation-message">
            {{ $errors->first('room.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.room.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('room.description') ? 'invalid' : '' }}">
        <label class="form-label required" for="description">{{ trans('cruds.room.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" required wire:model.defer="room.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('room.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.room.fields.description_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>