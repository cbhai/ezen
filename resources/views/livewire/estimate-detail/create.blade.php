<div>
    <div class="flex py-2 form-group">
        <h2 class="w-1/2">Project title: {{$estimate['title']}}</h2>
        <h2 class="w-1/2">Estimate ID : {{$estimate['id']}}</h2>

        <h2 class="w-1/2">Room name : {{$roomSelectedName}}</h2>
        </div>
    @if ($isCreateMode)
        <div class="py-2 form-group">
            <label class="form-label required" for="roomSelected">Select Room</label>
            <select class="w-1/2 form-control"  wire:model="roomSelected" name="roomSelected" id="">
                <option value="">Select a room</option>
                @foreach ($allRooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }} </option>
                @endforeach
            </select>
        </div>
    @else
        <h2 class="w-1/2">Room name : {{$roomSelectedName}}</h2>
    @endif


    <div class="overflow-hidden">
        <div class="overflow-x-auto ">
            <table @if (!$showTable) style="display:none" @endif
                class="table w-full border-solid table-index">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.rate') }}
                        </th>
                        <th>
                            {{-- {{ trans('cruds.estimateDetail.fields.unit') }} --}}
                            Unit
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.estimateDetail.fields.total') }}
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arrEstimateDetails as $index => $estimateDetail)
                    <tr>
                        <td>
                            @if ($estimateDetail['is_saved'])
                                 {{ $estimateDetail['name'] }}
                            @else
                                @if ($estimateDetail['row_type'] == 'addAllWorkitems')
                                    <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][name]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.name">
                                @elseif ($estimateDetail['row_type'] == 'addCustomWorkitem')
                                    <input class="form-control" type="text"
                                        name="arrEstimateDetails[{{$index}}][name]" required
                                        wire:model.defer="arrEstimateDetails.{{$index}}.name">
                                @elseif ($estimateDetail['row_type'] == 'addWorkitem')
                                    <select class="form-control"
                                        wire:model="workitemNameSelected"
                                        name="workitemNameSelected">
                                        <option value="">Select workitem</option>
                                        @foreach ($allWorkitems as $workitem)
                                            <option value="{{$workitem->id . "-" . $index}}">{{$workitem->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                                @if($errors->has('arrEstimateDetails.' . $index . 'name'))
                                    <em class="text-sm text-red-500">
                                        {{ $errors->first('arrEstimateDetails.' . $index . 'name') }}
                                    </em>
                                @endif
                            @endif
                            {{-- Error if trying to add new row while previous row not saved --}}
                            @if($errors->has('arrEstimateDetails.' . $index))
                                <em class="text-sm text-red-500">
                                    {{ $errors->first('arrEstimateDetails.' . $index) }}
                                </em>
                            @endif
                        </td>
                        <td>
                            @if ($estimateDetail['is_saved'])
                            {{ $estimateDetail['description'] }}
                            @else
                                @if ($estimateDetail['row_type'] == 'addAllWorkitems')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][description]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.description">
                                @elseif ($estimateDetail['row_type'] == 'addCustomWorkitem')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][description]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.description">
                                @elseif ($estimateDetail['row_type'] == 'addWorkitem')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][description]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.description">
                                @endif
                                @if($errors->has('arrEstimateDetails.' . $index . 'description'))
                                    <em class="text-sm text-red-500">
                                        {{ $errors->first('arrEstimateDetails.' . $index . 'description') }}
                                    </em>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($estimateDetail['is_saved'])
                            {{ $estimateDetail['rate'] }}
                            @else
                                @if ($estimateDetail['row_type'] == 'addAllWorkitems')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][rate]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.rate">
                                @elseif ($estimateDetail['row_type'] == 'addCustomWorkitem')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][rate]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.rate">
                                @elseif ($estimateDetail['row_type'] == 'addWorkitem')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][rate]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.rate">
                                @endif
                                @if($errors->has('arrEstimateDetails.' . $index . 'rate'))
                                    <em class="text-sm text-red-500">
                                        {{ $errors->first('arrEstimateDetails.' . $index . 'rate') }}
                                    </em>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($estimateDetail['is_saved'])
                            {{ $estimateDetail['unit'] }}
                            @else
                                @if ($estimateDetail['row_type'] == 'addAllWorkitems')
                                <input disabled class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][unit]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.unit">
                                @elseif ($estimateDetail['row_type'] == 'addCustomWorkitem')
                                    <select class="form-control"
                                        wire:model="arrEstimateDetails.{{$index}}.unit"
                                        name="arrEstimateDetails[{{$index}}][unit]">
                                        <option value="">Select workitem</option>
                                        <option value="sft">Per Sq.ft.</option>
                                        <option value="rft">Per R.ft.</option>
                                        <option value="lumsum">Lumsum</option>
                                    </select>
                                @elseif ($estimateDetail['row_type'] == 'addWorkitem')
                                <input disabled class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][unit]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.unit">
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($estimateDetail['is_saved'])
                            {{ $estimateDetail['quantity'] }}
                            @else
                                @if ($estimateDetail['row_type'] == 'addAllWorkitems')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][quantity]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.quantity">
                                @elseif ($estimateDetail['row_type'] == 'addCustomWorkitem')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][quantity]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.quantity">
                                @elseif ($estimateDetail['row_type'] == 'addWorkitem')
                                <input class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][quantity]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.quantity">
                                @endif
                                @if($errors->has('arrEstimateDetails.' . $index . 'quantity'))
                                    <em class="text-sm text-red-500">
                                        {{ $errors->first('arrEstimateDetails.' . $index . 'quantity') }}
                                    </em>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($estimateDetail['is_saved'])
                            {{$estimateDetail['total']}}
                            @else
                                @if ($estimateDetail['row_type'] == 'addAllWorkitems')
                                <input disabled class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][total]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.total">
                                @elseif ($estimateDetail['row_type'] == 'addCustomWorkitem')
                                <input disabled class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][total]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.total">
                                @elseif ($estimateDetail['row_type'] == 'addWorkitem')
                                <input disabled class="form-control" type="text"
                                         name="arrEstimateDetails[{{$index}}][total]" required
                                         wire:model.defer="arrEstimateDetails.{{$index}}.total">
                                @endif
                            @endif
                        </td>
                        <td>
                            <div class="flex justify-end">
                                @if ($estimateDetail['is_saved'])
                                <button class="mr-2 btn btn-sm btn-info" wire:click.prevent="editWorkitem({{$index}})">Edit</button>
                                @else
                                <button class="mr-2 btn btn-sm btn-success" wire:click.prevent="saveWorkitem({{$index}})">Save</button>
                                @endif
                                <button class="mr-2 btn btn-sm btn-rose" wire:click.prevent="removeWorkitem({{$index}})">Delete</button>
                            </div>
                            {{-- <div class="flex justify-end">
                                @can('estimate_detail_show')
                                    <a class="mr-2 btn btn-sm btn-info" href="{{ route('admin.estimate-details.show', $estimateDetail) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('estimate_detail_edit')
                                    <a class="mr-2 btn btn-sm btn-success" href="{{ route('admin.estimate-details.edit', $estimateDetail) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('estimate_detail_delete')
                                    <button class="mr-2 btn btn-sm btn-rose" type="button" wire:click="confirm('delete', {{ $estimateDetail->id }})" wire:loading.attr="disabled">
                                        {{ trans('global.delete') }}
                                    </button>
                                @endcan --}}
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="10">No Workitems added yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-group">

        <div>
            <button @if (!$showAddItem) style="display:none" @endif class="mr-2 btn btn-sm btn-info" wire:click.prevent="addWorkitem">Add Item</button>
            <button @if (!$showAddCustomItem) style="display:none" @endif class="mr-2 btn btn-sm btn-info" wire:click.prevent="addCustomWorkitem">Add Custom Item</button>
            <button @if (!$showAddAllItem) style="display:none" @endif class="mr-2 btn btn-bg btn-info" wire:click.prevent="addAllWorkitems">Add All Items</button>
        </div>
    </div>
    <div class="form-group">
        <h2 class="w-1/2 justify-left">Total : {{$roomTotal}}</h2>
    </div>
    <div class="form-group">
        <div>
            <button @if (!$showSaveRoom) style="display:none" @endif class="mr-2 btn btn-sm btn-info" wire:click.prevent="saveEstimateDetails">Save Room</button>
            {{-- <button @if (!$showEditRoom) style="display:none" @endif class="mr-2 btn btn-sm btn-info" wire:click.prevent="saveRoom">Edit Room</button> --}}
            <button class="mr-2 btn btn-sm btn-rose" wire:click.prevent="cancel">{{ trans('global.cancel') }}</button>
        </div>
    </div>

</div>
