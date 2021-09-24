<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('workitem.room_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="room">{{ trans('cruds.workitem.fields.room') }}</label>
        <x-select-list class="form-control" required id="room" name="room" :options="$this->listsForFields['room']" wire:model="workitem.room_id" />
        <div class="validation-message">
            {{ $errors->first('workitem.room_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.workitem.fields.room_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('workitem.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.workitem.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="workitem.name">
        <div class="validation-message">
            {{ $errors->first('workitem.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.workitem.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('workitem.description') ? 'invalid' : '' }}">
        <label class="form-label required" for="description">{{ trans('cruds.workitem.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" required wire:model.defer="workitem.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('workitem.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.workitem.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('workitem.rate') ? 'invalid' : '' }}">
        <label class="form-label required" for="rate">{{ trans('cruds.workitem.fields.rate') }}</label>
        <input class="form-control" type="number" name="rate" id="rate" required wire:model.defer="workitem.rate" step="0.01">
        <div class="validation-message">
            {{ $errors->first('workitem.rate') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.workitem.fields.rate_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('workitem.unit') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.workitem.fields.unit') }}</label>
        <select class="form-control" wire:model="workitem.unit">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['unit'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('workitem.unit') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.workitem.fields.unit_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.workitems.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>