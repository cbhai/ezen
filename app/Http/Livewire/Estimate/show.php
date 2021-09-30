<?php

namespace App\Http\Livewire\Estimate;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Estimate;
use App\Models\EstimateDetail;
use App\Models\Room;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public Estimate $estimate;
    public $tableArray = [];
    public $tableArrayRoomID = [];
    public $tableArrayRoomTotal = [];

    public $allRooms = [];

    public $arrEstimateDetails = [];

    public $roomDetailHolder = [];

    public function mount($estimate)
    {
        $this->estimate = $estimate;

        $this->allRooms = Room::all();

        $this->tableArrayRoomID = EstimateDetail::where('estimate_id', $this->estimate->id)
        ->distinct('room_id')->pluck('room_id');



        foreach($this->tableArrayRoomID as $key => $item){

            $rtotal = EstimateDetail::where('estimate_id', $this->estimate->id)
            ->where('room_id', "=" , $this->tableArrayRoomID[$key])
            ->pluck('total')->sum();

            //$room =  $this->allRooms->where('id', $this->tableArrayRoomID[$key])->first();
            $room = $this->allRooms->where('id', $this->tableArrayRoomID[$key])->first();

            $this->tableArray[] = [
            'room_id' => $this->tableArrayRoomID[$key],
            'roomName' => $room->name,
            'roomTotal' => $rtotal,
            ];

            $estDetailsEditmode = EstimateDetail::where([
                'estimate_id' => $this->estimate->id,
                'room_id'   => $this->tableArrayRoomID[$key],
            ])->get();

            //load EstimateDetails for each room
            foreach($estDetailsEditmode as $item){
                //ddd($item);
                // $this->arrEstimateDetails[] = [
                $this->arrEstimateDetails[] = [
                    'id' =>$item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'unit' => $item->unit,
                    'rate' => $item->rate,
                    'quantity' => $item->quantity,
                    'total' => $item->total,
                    'estimate_id' => $item-> estimate_id,
                    'room_id' => $item-> room_id,
                    'is_saved' => true,
                    'row_type' => 'addAllWorkitems',
                ];
            }
        }

        //dd($this->arrEstimateDetails);
    }

    public function render()
    {

        return view('livewire.estimate.show');
    }


}
