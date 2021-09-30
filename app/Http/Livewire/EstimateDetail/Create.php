<?php

namespace App\Http\Livewire\EstimateDetail;

use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateDetail;
use App\Models\Room;
use App\Models\Workitem;
use Livewire\Component;

class Create extends Component
{
    public array $listsForFields = [];

    //public EstimateDetail $estimateDetail;

    public $estimate_id;
    public Estimate $estimate;
    public Customer $customer;
    //public $estimateID;
    public $clientID;
    //public $estimateTitle;

    public $allRooms = [];
    public $addedRooms = [];
    public $roomSelected;
    public $roomSelectedName;
    public $allWorkitems;
    public $showAddItem = false;
    public $showAddCustomItem = false;
    public $showAddAllItem = false;
    public $showTable = false;
    public $showSaveRoom = false;
    public $showEditRoom= false;
    public $workitemNameSelected;
    public $arrEstimateDetails = [];
    public $estimateDetailSaved = false;

    public $roomTotal;

    public $isCreateMode;
    //public $estDetailsEditmode;

    public function mount($estimate_id, $room_id = null)
    {
        //dd('estimate_id is ' . $estimate_id . ' and room_id is ' . $room_id);
        $this->isCreateMode = true;
        //estimate_id will always come
        if(!empty($estimate_id)){
            //as of now dont see any need for fetching whoel estimate object but lets see
            $this->estimate = Estimate::where('id', '=' , $this->estimate_id)->first();
            $this->customer = Customer::where('id', '=' , $this->estimate->customer_id)->first();

            if(!empty($room_id)){

                $this->reset('arrEstimateDetails', 'allWorkitems');
                $this->resetErrorBag();

                $this->isCreateMode = false;
                $this->roomSelected = $room_id;

                //Not very efficeint, dont know how to extract from allRooms
                $this->roomSelectedName = Room::where('id', $this->roomSelected)->first()->name;

                //add Workitems

                $this->showAddCustomItem = true;
                $this->showTable = true;
                $this->showSaveRoom = true;
                $this->showEditRoom = true;
                $this->showAddAllItem = true;
                $this->showAddItem = true;


                $estDetailsEditmode = EstimateDetail::where([
                    'estimate_id' => $this->estimate->id,
                    'room_id'   => $this->roomSelected,
                ])->get();

                $rTotal = 0;
                foreach($estDetailsEditmode as $item){
                    //ddd($item);
                    $this->arrEstimateDetails[] = [
                        'id' =>$item->id,
                        'name' => $item->name,
                        'description' => $item->description,
                        'unit' => $item->unit,
                        'rate' => $item->rate,
                        'quantity' => $item->quantity,
                        'total' => $item->total,
                        'is_saved' => true,
                        'row_type' => 'addAllWorkitems',
                    ];
                    $rTotal = $rTotal + $item->total;
                }
                //dd($this->arrEstimateDetails);
                $this->roomTotal = $rTotal;

                $this->allWorkitems = Workitem::where(['room_id' => $this->roomSelected])->get();


            }else{
                $this->addedRooms = EstimateDetail::groupBy('room_id')
                                    ->where('estimate_id' , '=', $this->estimate->id)
                                    ->pluck('room_id');
                $this->allRooms = Room::all()->whereNotIn('id', $this->addedRooms);
            }

        }
        else
        {
            return $this->redirect(route('admin.estimates.index'));
        }
    }

    public function render()
    {
        return view('livewire.estimate-detail.create');
    }

    public function UpdatedroomSelected(){

        //dd('UpdatedroomSelected');
        $this->reset('arrEstimateDetails', 'allWorkitems');
        $this->resetErrorBag();

        if(!empty($this->roomSelected)){
            //moved to mount
            $this->allWorkitems = Workitem::where(['room_id' => $this->roomSelected])->get();

            //Not very efficeint, dont know how to extract from allRooms
            $this->roomSelectedName = Room::where('id', $this->roomSelected)->first()->name;


            $this->showAddItem = true;
            $this->showAddCustomItem = true;
            $this->showAddAllItem = true;
            $this->showTable = true;
            $this->showSaveRoom = true;
            $this->showEditRoom = true;
        }else{
            $this->showAddItem = false;
            $this->showAddCustomItem = false;
            $this->showAddAllItem = false;
            $this->showSaveRoom = false;
            $this->showEditRoom = false;

        }
    }

    public function addWorkitem(){
        //Hides Button AddAllWorkitems ??

        //Adds Dropdown inside Workitem Name field - selectWorkitemName
        // all other fields empty

        //Once selectWorkitemName selected (selectedWorkitemName) field changes pull all detaisl and fill boxes

        // implement logic used for all rooms, remove item from lsit which is already used

        foreach ($this->arrEstimateDetails as $key => $item) {
            if (!$item['is_saved']) {
                $this->addError('arrEstimateDetails.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }


        $this->arrEstimateDetails[] = [
            'name' => "",
            'description' => "",
            'unit' => "",
            'rate' => "",
            'quantity' => null,
            'total' => null,
            'is_saved' => false,
            'row_type' => 'addWorkitem',
        ];

        $this->showAddAllItem = false;
        $this->workitemSaved = false;
    }

    public function addCustomWorkitem(){
        //Hides Button AddAllWorkitems ??
        //adds all empty boxes

        foreach ($this->arrEstimateDetails as $key => $item) {
            if (!$item['is_saved']) {
                $this->addError('arrEstimateDetails.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }

        $this->arrEstimateDetails[] = [
            'name' => "",
            'description' => "",
            'unit' => "",
            'rate' => "",
            'quantity' => null,
            'total' => null,
            'is_saved' => false,
            'row_type' => 'addCustomWorkitem',
        ];

        $this->workitemSaved = false;
    }
    public function addAllWorkitems(){

        foreach($this->allWorkitems as $item){
            //ddd($item);
            $this->arrEstimateDetails[] = [
                'name' => $item->name,
                'description' => $item->description,
                'unit' => $item->unit,
                'rate' => $item->rate,
                'quantity' => null,
                'total' => null,
                'is_saved' => false,
                'row_type' => 'addAllWorkitems',
            ];
        }

        $this->showAddAllItem = false;
        $this->showAddItem = false;
        $this->workitemSaved = false;
    }
    public function editWorkitem($index){

        foreach ($this->arrEstimateDetails as $key => $workitem) {
            if (!$workitem['is_saved']) {
                $this->addError('arrEstimateDetails.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }
        $this->arrEstimateDetails[$index]['is_saved'] = false;
    }

    /*
    public function addWorkitemsEditMode(){

        $this->showAddCustomItem = true;
        $this->showTable = true;
        $this->showSaveRoom = true;
        $this->showEditRoom = true;
        $this->showAddAllItem = false;
        $this->showAddItem = false;


        $this->estDetailsEditmode = EstimateDetail::where([
            'esimate_id' => $this->estimate->id,
            'room_id'   => $this->room_id,
        ])->get();

        $rTotal = 0;
        foreach($this->estDetailsEditmode as $item){
            //ddd($item);
            $this->arrEstimateDetails[] = [
                'name' => $item->name,
                'description' => $item->description,
                'unit' => $item->unit,
                'rate' => $item->rate,
                'quantity' => $item->quantity,
                'total' => $item->total,
                'is_saved' => true,
                'row_type' => $item->row_type,
            ];
            $rTotal = $rTotal + $item->total;
        }
        $this->roomTotal = $rTotal;

        $this->allWorkitems = Workitem::where(['room_id' => $this->roomSelected])->get();


        $listRowType = $this->estDetailsEditmode
                        ->whereIn('row_type', ['addAllWorkitems', 'addWorkitem']);

        $this->showAddCustomItem = true;
        $this->showTable = true;
        $this->showSaveRoom = true;
        $this->showEditRoom = true;

        if(!empty($listRowType)){
            $this->showAddAllItem = false;
            $this->showAddItem = false;
        }else{
            $this->showAddAllItem = true;
            $this->showAddItem = true;
        }

        //$this->workitemSaved = false;
    }
*/

    public function saveWorkitem($index){
        $this->resetErrorBag();

        if (empty($this->arrEstimateDetails[$index]['name'])) {
            $this->addError('arrEstimateDetails.' . $index . 'name', 'Name cannot be empty');
            return;
        }
        if (empty($this->arrEstimateDetails[$index]['description'])) {
            $this->addError('arrEstimateDetails.' . $index . 'description', 'Description cannot be empty');
            return;
        }
        if (empty($this->arrEstimateDetails[$index]['rate']) || $this->arrEstimateDetails[$index]['rate'] < 1) {
            $this->addError('arrEstimateDetails.' . $index . 'rate', 'Rate required.');
            return;
        }
        // if (empty($this->arrEstimateDetails[$index]['unit']) || $this->arrEstimateDetails[$index]['unit'] < 1) {
        //     $this->addError('arrEstimateDetails.' . $index . 'unit', 'unit required.');
        //     return;
        // }
        if (empty($this->arrEstimateDetails[$index]['quantity']) || $this->arrEstimateDetails[$index]['quantity'] < 1) {
            $this->addError('arrEstimateDetails.' . $index . 'quantity', 'Quantity required.');
            return;
        }

        // //rules with wildcard
        // $this->validateOnly($this->arrEstimateDetails[$index]['name'],
        //     $this->arrEstimateDetails[$index]['description'],
        //     $this->arrEstimateDetails[$index]['rate'],
        //     $this->arrEstimateDetails[$index]['quantity'],
        // );

        //$product = $this->allProducts->find($this->invoiceProducts[$index]['product_id']);
        //$this->invoiceProducts[$index]['product_name'] = $product->name;
        $this->arrEstimateDetails[$index]['total'] = $this->arrEstimateDetails[$index]['quantity'] * $this->arrEstimateDetails[$index]['rate'];
        $this->roomTotal = $this->roomTotal +  $this->arrEstimateDetails[$index]['total'];
        $this->arrEstimateDetails[$index]['is_saved'] = true;
    }
    public function removeWorkitem($index){
        $this->roomTotal = $this->roomTotal -  $this->arrEstimateDetails[$index]['total'];

        //is in Edit mode you have to also delete estimatedetails from database
        if(!$this->isCreateMode){
            $eDetailDeleted = EstimateDetail::find($this->arrEstimateDetails[$index]['id']);
            $eDetailDeleted->delete();
        }

        unset($this->arrEstimateDetails[$index]);
        $this->arrEstimateDetails = array_values($this->arrEstimateDetails);

        if(empty($this->arrEstimateDetails)){
            $this->showAddAllItem = true;
            $this->showAddCustomItem = true;
            $this->showAddItem = true;
        }
    }
    public function UpdatedworkitemNameSelected(){
        //dropdown is bringing option selected & index in a string separated by -
        $strNumbers = explode("-", $this->workitemNameSelected);


        $optionSelected = (int)$strNumbers[0];
        $localIndex = (int)$strNumbers[1];

        $item = $this->allWorkitems->find($optionSelected);

        $this->arrEstimateDetails[$localIndex]['name'] = $item['name'];
        $this->arrEstimateDetails[$localIndex]['description'] = $item['description'];
        $this->arrEstimateDetails[$localIndex]['rate'] = $item['rate'];

        $this->arrEstimateDetails[$localIndex]['unit'] = $item['unit'];
        $this->arrEstimateDetails[$localIndex]['quantity'] = null;
        $this->arrEstimateDetails[$localIndex]['total'] = null;
        $this->arrEstimateDetails[$localIndex]['is_saved'] = 0;
        $this->arrEstimateDetails[$localIndex]['row_type'] = "addWorkitem";

        //Nitin-To-Do
        //Place to remove item from $this->allWorkitems which was already used
        //deciding not to do this, if there is need in future will do it
        //$item = $this->allWorkitems->find($optionSelected);

        /***
        $this->addedWorkitems = EstimateDetail::groupBy('room_id')
        ->where('estimate_id' , '=', $this->estimate->id)
        ->pluck('room_id');
        //dd($this->addedRooms);

        $this->allRooms = Room::all()->whereNotIn('id', $this->addedRooms);

        if item is deleted/removed we have to add back
        */
    }

    public function saveEstimateDetails(){
        //$this->validate();

        //$this->estimateDetail->save();
        if($this->isCreateMode){

            $workItemsArray = [];
            foreach ($this->arrEstimateDetails as $key => $workitem){

                $workItemsArray[$key]['name'] = $this->arrEstimateDetails[$key]['name'];
                $workItemsArray[$key]['description'] = $this->arrEstimateDetails[$key]['description'];
                $workItemsArray[$key]['rate'] = $this->arrEstimateDetails[$key]['rate'];
                $workItemsArray[$key]['unit'] = $this->arrEstimateDetails[$key]['unit'];
                $workItemsArray[$key]['quantity'] = $this->arrEstimateDetails[$key]['quantity'];
                $workItemsArray[$key]['total'] = $this->arrEstimateDetails[$key]['total'];
                $workItemsArray[$key]['estimate_id'] = $this->estimate->id;
                $workItemsArray[$key]['room_id'] = $this->roomSelected;
                $workItemsArray[$key]['owner_id'] = auth()->id();
            }

            EstimateDetail::insert($workItemsArray);
        }else{

            // In update mode existing will get updated & new rows will get insert
            foreach ($this->arrEstimateDetails as $key => $workitem){
                if(!empty($this->arrEstimateDetails[$key]['id'])){
                    //update // save
                    $eDetail = EstimateDetail::find($this->arrEstimateDetails[$key]['id']);

                    $eDetail->name = $this->arrEstimateDetails[$key]['name'];

                    $eDetail->description = $this->arrEstimateDetails[$key]['description'];
                    $eDetail->rate = $this->arrEstimateDetails[$key]['rate'];
                    $eDetail->unit = $this->arrEstimateDetails[$key]['unit'];
                    $eDetail->quantity = $this->arrEstimateDetails[$key]['quantity'];
                    $eDetail->total = $this->arrEstimateDetails[$key]['total'];
                    $eDetail->estimate_id = $this->estimate->id;
                    $eDetail->room_id = $this->roomSelected;
                    $eDetail->owner_id = auth()->id();

                    $eDetail->save();

                }else{
                    EstimateDetail::create([
                        'name' => $this->arrEstimateDetails[$key]['name'],
                        'description' => $this->arrEstimateDetails[$key]['description'],
                        'rate' => $this->arrEstimateDetails[$key]['rate'],
                        'unit' => $this->arrEstimateDetails[$key]['unit'],
                        'quantity' => $this->arrEstimateDetails[$key]['quantity'],
                        'total' => $this->arrEstimateDetails[$key]['total'],
                        'estimate_id' => $this->estimate->id,
                        'room_id' => $this->roomSelected,
                        'owner_id' => auth()->id(),
                    ]);
                }
            }
        }


        $this->reset('arrEstimateDetails');
        $this->estimateDetailSaved = true;

        return $this->redirect(route('admin.estimates.create', ['id' => $this->estimate->id]));
        //return redirect()->route('admin.estimate-details.index');
    }
    public function cancel(){
        return $this->redirect(route('admin.estimates.create', ['id' => $this->estimate->id]));
    }


    protected function rules(): array
    {
        return [
            'arrEstimateDetails.*.name' => [
                'required',
            ],
            'arrEstimateDetails.*.description' => [
                'required',
            ],
            'arrEstimateDetails.*.rate' => [
                'required',
                'numeric',
            ],
            'arrEstimateDetails.*.quantity' => [
                'required',
                'numeric',
            ],



            // 'estimateDetail.estimate_id' => [
            //     'integer',
            //     'exists:estimates,id',
            //     'required',
            // ],
            // 'estimateDetail.room_id' => [
            //     'integer',
            //     'exists:rooms,id',
            //     'required',
            // ],
            // 'estimateDetail.name' => [
            //     'string',
            //     'required',
            // ],
            // 'estimateDetail.description' => [
            //     'string',
            //     'required',
            // ],
            // 'estimateDetail.rate' => [
            //     'numeric',
            //     'required',
            // ],
            // 'estimateDetail.quantity' => [
            //     'numeric',
            //     'nullable',
            // ],
            // 'estimateDetail.total' => [
            //     'numeric',
            //     'required',
            // ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['estimate'] = Estimate::pluck('title', 'id')->toArray();
        $this->listsForFields['room']     = Room::pluck('name', 'id')->toArray();
    }
}
