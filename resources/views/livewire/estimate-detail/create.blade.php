<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('estimateDetail.estimate_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="estimate">{{ trans('cruds.estimateDetail.fields.estimate') }}</label>
        <x-select-list class="form-control" required id="estimate" name="estimate" :options="$this->listsForFields['estimate']" wire:model="estimateDetail.estimate_id" />
        <div class="validation-message">
            {{ $errors->first('estimateDetail.estimate_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.estimate_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.room_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="room">{{ trans('cruds.estimateDetail.fields.room') }}</label>
        <x-select-list class="form-control" required id="room" name="room" :options="$this->listsForFields['room']" wire:model="estimateDetail.room_id" />
        <div class="validation-message">
            {{ $errors->first('estimateDetail.room_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.room_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.estimateDetail.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="estimateDetail.name">
        <div class="validation-message">
            {{ $errors->first('estimateDetail.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.description') ? 'invalid' : '' }}">
        <label class="form-label required" for="description">{{ trans('cruds.estimateDetail.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" required wire:model.defer="estimateDetail.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('estimateDetail.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.rate') ? 'invalid' : '' }}">
        <label class="form-label required" for="rate">{{ trans('cruds.estimateDetail.fields.rate') }}</label>
        <input class="form-control" type="number" name="rate" id="rate" required wire:model.defer="estimateDetail.rate" step="0.01">
        <div class="validation-message">
            {{ $errors->first('estimateDetail.rate') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.rate_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.unit') ? 'invalid' : '' }}">
        <label class="form-label required">{{ trans('cruds.estimateDetail.fields.unit') }}</label>
        <select class="form-control" wire:model="estimateDetail.unit">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['unit'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('estimateDetail.unit') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.unit_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.quantity') ? 'invalid' : '' }}">
        <label class="form-label required" for="quantity">{{ trans('cruds.estimateDetail.fields.quantity') }}</label>
        <input class="form-control" type="number" name="quantity" id="quantity" required wire:model.defer="estimateDetail.quantity" step="0.01">
        <div class="validation-message">
            {{ $errors->first('estimateDetail.quantity') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.quantity_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('estimateDetail.total') ? 'invalid' : '' }}">
        <label class="form-label required" for="total">{{ trans('cruds.estimateDetail.fields.total') }}</label>
        <input class="form-control" type="number" name="total" id="total" required wire:model.defer="estimateDetail.total" step="0.01">
        <div class="validation-message">
            {{ $errors->first('estimateDetail.total') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.estimateDetail.fields.total_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.estimate-details.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>