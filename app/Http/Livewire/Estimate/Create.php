<?php

namespace App\Http\Livewire\Estimate;

use App\Models\Branding;
use App\Models\BusinessProfile;
use App\Models\Customer;
use App\Models\Estimate;
use App\Models\EstimateDetail;
use App\Models\PDFEstimateDetailsItem;
use App\Models\PDFEstimateItem;
use App\Models\PDFEstimatePDF;
use App\Models\PDFRoomItem;
use App\Models\Room;
use App\Models\Term;
use Carbon\Carbon;
use LaravelDaily\Invoices\Classes\EstimateDetailsItem;
use LaravelDaily\Invoices\Classes\EstimateItem;
use LaravelDaily\Invoices\Classes\Party;

use Livewire\Component;

class Create extends Component
{
    public Estimate $estimate;

    //public array $listsForFields = [];


    public BusinessProfile $businessProfile;
    public $allCustomers = [];
    public $allRooms = [];
    //public $terms;

    public $estimate_total;
    public Customer $customer;

    public $tableArray = [];
    public $tableArrayRoomID = [];
    public $tableArrayRoomTotal = [];

    public function mount($id = null, Estimate $estimate , Customer $customer)
    {
        $this->customer = $customer;
        $this->estimate         = $estimate;
        $this->estimate->header = true;
        $this->estimate->footer = true;
        //$this->initListsForFields();

        //This is must. If business profile still not filled redirect user
        $this->businessProfile = BusinessProfile::where('owner_id', auth()->id())->first();

        $this->allCustomers = Customer::all();
        $this->allRooms = Room::all();

        $t =  Term::where('owner_id', auth()->id())->first();
        if(!empty($t)){
            $this->estimate_terms = $t->terms;

        }else{
            $this->estimate_terms = "";
        }
        $this->estimate->terms = $this->estimate_terms;

        //dd($this->estimate->terms);
        //$this->terms
        //if coming back to create page after adding room details on EstimateDetails
        if(!empty($id)){

            //Load Estimate
            $this->estimate = Estimate::where('id', $id)->first();

            $this->customer = $this->allCustomers->find($this->estimate->customer_id);

            $this->tableArrayRoomID = EstimateDetail::where('estimate_id', $id)
                                        ->distinct('room_id')->pluck('room_id');

            foreach($this->tableArrayRoomID as $key => $item){

                $rtotal = EstimateDetail::where('estimate_id', "=" , $id)
                    ->where('room_id', "=" , $this->tableArrayRoomID[$key])
                    ->pluck('total')->sum();

                $room =  $this->allRooms->where('id', $this->tableArrayRoomID[$key])->first();

                $this->tableArray[] = [
                    'room_id' => $this->tableArrayRoomID[$key],
                    'roomName' => $room->name,
                    'roomTotal' => $rtotal,
                    ];

            }
            //dd($this->tableArray);
            $this->estimate_total = 0;
            foreach($this->tableArray as $room){
                $this->estimate_total = $this->estimate_total + $room['roomTotal'];
            }
            $this->estimate->total = $this->estimate_total;
            //dd($this->estimate->total);
        }
    }

    public function render()
    {
        return view('livewire.estimate.create');
    }

    public function updated($name, $value)
    {
        //dd($name . "-" . $this->estimate->customer_id . "-" . $value);

        //if condition getting called even for datechange, have to find out reason
        if($name = "estimate.customer_id"){
           if(!empty($this->estimate->customer_id)){
                //Ignore error red line. Studio shows error line but code works.
                $this->customer = $this->allCustomers->find($this->estimate->customer_id);

            }
        }
    }
    public function submit()
    {
        $this->validate();

        //validation to be done
        // no rooms added yet -> this inderectly enforces creation of estimate object
        //estimate object creation enforces selection of client

        //only validation remains is terms & branding

        $this->estimate->total = $this->estimate_total;
        $this->estimate->terms = $this->estimate_terms;
        //dd($this->estimate);
        $this->estimate->save();

        //NITIN-TO-DO
        //Flash message that Estimate is Saved


        //return $this->redirect()->route('admin.estimate-details.create');
        return redirect()->route('admin.estimates.index');
    }

    public function UpdatedcustomerID(){

        //Ignore error red line. Studio shows error line but code works.
        $customerSelected = $this->allCustomers->find($this->customerID);
        //dd($customerSelected);
        //$customerSelected = $this->allCustomers->find($this->customerID);

        $this->clientAddress = $customerSelected->address;
        $this->clientEmail = $customerSelected->email;
        $this->clientPhone = $customerSelected->phone;
        //$this->clientLocation = $customerSelected->phone;
        // 'id',
        // 'first_name',
        // 'last_name',
        // 'status.name',
        // 'email',
        // 'phone',
        // 'address',
        // 'description',

    }

    public function addRoom(){

        //instead of  estimate, check for estimate->id
        $this->validate([
                'estimate.title' => [
                'string',
                'required',
            ],
            'estimate.customer_id' => [
                //'integer',
                'required',
                'exists:customers,id',
            ],
            'estimate.date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
        ]);

        if(empty($this->estimate->id)){
            //$this->estimateIDCreated = true;
            $estimate = Estimate::create([
                'title' => $this->estimate->title,
                'date' => $this->estimate->date,
                'customer_id' => $this->estimate->customer_id,
                'total' => 0,
            ]);
            $this->estimate = $estimate;
        }

        return $this->redirect(route('admin.estimate-details.create', ['estimate_id' => $this->estimate->id]));

    }

    protected function rules(): array
    {
        return [
            'estimate.title' => [
                'string',
                'required',
            ],
            'estimate.customer_id' => [
                'integer',
                'exists:customers,id',
                'required',
            ],
            'estimate.date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'estimate.terms' => [
                'string',
                'nullable',
            ],
            'estimate.header' => [
                'boolean',
            ],
            'estimate.footer' => [
                'boolean',
            ],
             'estimate.total' => [
                 'numeric',
                 'required',
             ],
        ];
    }

    /***
    public function printbkp(){

        $this->validate();
        if(count($this->tableArray) < 1  ){
            return;
        }

        $logo_url = "";
        $branding = Branding::where('owner_id', auth()->id())->first();

        foreach($branding->logo as $key => $entry){
            $logo_url = $entry['url'];
        }
        //dd($logo_url);
        //dd($branding->logo);
        if(empty($logo_url)){
            //$logo_url = asset('vendor/invoices/estimate-zen.png');
            $logo_url = public_path('vendor/invoices/estimate-zen.png');
        }

        //dd($logo_url);

        $pro = new Party([
            'business_name' => $this->businessProfile->company_name,
            'name'          => $this->businessProfile->fullName(),
            'phone'         => $this->businessProfile->phone,
            'email'         => $this->businessProfile->email,
            'address'       => isset($this->businessProfile->street_address) ? $this->businessProfile->street_address : "",
            'city'          => $this->businessProfile->city,
            'state'         => $this->businessProfile->state,
            'custom_fields' => [
                //'note'        => 'IDDQD',
                //'business id' => '365#GG',
            ],
        ]);

        $customer = new Party([
            'name'          => $this->customer->fullName() ,
            'phone'         => isset($this->customer->phone) ? $this->customer->phone : "",
            'email'         => isset($this->customer->email) ? $this->customer->email : "",
            'address'       => isset($this->customer->address) ? $this->customer->address : "",
            'city'          => isset($this->customer->city) ? $this->customer->city : "",
            'state'         => isset($this->customer->state) ? $this->customer->state : "",
            'custom_fields' => [
                //'order number' => '> 654321 <',
            ],
        ]);

        // $notes = [
        //     'Note: This estimate is not a contract or a bill. It is our best guess at the total price to complete the work stated above, based upon our ',
        //     'initial inspection. If prices changes or additional material and labour are required, we will inform you prior to proceeding with the work.',
        // ];
        //$notes = implode("<br>", $this->terms);

        //$this->estimate->terms = $notes;

        //dd($this->estimate->terms);
        $this->estimate->terms = $this->estimate_terms;
        $this->estimate->total = $this->estimate_total;

        $estimateItem = (new EstimateItem())
                        ->EstimateID($this->estimate->id)
                        ->EstimateTitle($this->estimate->title)
                        ->EstimateTotal($this->estimate->total)
                        ->EstimateDate($this->estimate->date)
                        ->EstimateTerms($this->estimate->terms)
                        ->EstimateAddHeader(isset($this->estimate->header) ? $this->estimate->header : 0)
                        ->EstimateAddFooter (isset($this->estimate->footer) ? $this->estimate->footer : 0)
                        ->EstimateHeader($branding->header)
                        ->EstimateFooter($branding->footer);

        //dd($this->estimate->header . '-' . $this->estimate->footer);

        //dd($estimateItem);

        $now = Carbon::now();
        $unique_code = $now->format('YmdHi');
        $file_name = 'Estimate-' . $this->customer->fullName() . '-' . $unique_code . '.pdf';

        $pdfrooms = [];
        foreach($this->tableArray as $room){
            //dd($this->estimate->id . " " . $room['room_id']);

            $workitems = EstimateDetail::where([
                ['estimate_id', $this->estimate->id],
                ['room_id', $room['room_id']],
            ])->get();

            foreach($workitems as $item){

                $pdfitems[] = [
                    (new EstimateDetailsItem())
                        ->WorkitemName($item['name'])
                        ->WorkitemDescription($item['description'])
                        ->WorkitemRate($item['rate'])
                        //->WorkitemUnit($item['unit_type']) cbq4 does not have unit in db
                        ->WorkitemQuantity($item['quantity'])
                        ->WorkitemTotal($item['total'])
                ];
            }

            $pdfrooms[] = [
                (new RoomItem())->roomTitle($room['roomName'])->roomTotal($room['roomTotal'])->roomWorkitems($pdfitems)
            ];

            $pdfrooms1[] = [
                (new PDFRoomItem())->roomTitle($room['roomName'])->roomTotal($room['roomTotal'])->roomWorkitems($pdfitems)
            ];

            unset($pdfitems);
         }

        $invoice = PDFEstimatePDF::make('Estimate')
            ->series('BIG')
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($pro)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('d/m/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($file_name)
            //->addItems($items)
            ->addRooms($pdfrooms1)
            ->addEstimateItem($estimateItem)
            ->notes($this->estimate->terms)
            //->logo(public_path('vendor/invoices/sample-logo.png'))
            ->logo($logo_url)
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link
        //dd($link);
        //dd($customer->name);
        return response()->streamDownload(function () use($invoice) {
            echo  $invoice->stream();
        }, $file_name);
    }
    */
    public function print(){

        $this->validate();
        if(count($this->tableArray) < 1  ){
            return;
        }

        $logo_url = "";
        $branding = Branding::where('owner_id', auth()->id())->first();

        foreach($branding->logo as $key => $entry){
            $logo_url = $entry['url'];
        }
        //dd($logo_url);
        //dd($branding->logo);
        if(empty($logo_url)){
            //$logo_url = asset('vendor/invoices/estimate-zen.png');
            $logo_url = public_path('vendor/invoices/estimate-zen.png');
        }

        //dd($logo_url);

        $pro = new Party([
            'business_name' => $this->businessProfile->company_name,
            'name'          => $this->businessProfile->fullName(),
            'phone'         => $this->businessProfile->phone,
            'email'         => $this->businessProfile->email,
            'address'       => isset($this->businessProfile->street_address) ? $this->businessProfile->street_address : "",
            'city'          => $this->businessProfile->city,
            'state'         => $this->businessProfile->state,
            'custom_fields' => [
                //'note'        => 'IDDQD',
                //'business id' => '365#GG',
            ],
        ]);

        $customer = new Party([
            'name'          => $this->customer->fullName() ,
            'phone'         => isset($this->customer->phone) ? $this->customer->phone : "",
            'email'         => isset($this->customer->email) ? $this->customer->email : "",
            'address'       => isset($this->customer->address) ? $this->customer->address : "",
            'city'          => isset($this->customer->city) ? $this->customer->city : "",
            'state'         => isset($this->customer->state) ? $this->customer->state : "",
            'custom_fields' => [
                //'order number' => '> 654321 <',
            ],
        ]);

        // $notes = [
        //     'Note: This estimate is not a contract or a bill. It is our best guess at the total price to complete the work stated above, based upon our ',
        //     'initial inspection. If prices changes or additional material and labour are required, we will inform you prior to proceeding with the work.',
        // ];
        //$notes = implode("<br>", $this->terms);

        //$this->estimate->terms = $notes;

        //dd($this->estimate->terms);
        $this->estimate->terms = $this->estimate_terms;
        $this->estimate->total = $this->estimate_total;

        $pdfEstimateItem = (new PDFEstimateItem())
                        ->EstimateID($this->estimate->id)
                        ->EstimateTitle($this->estimate->title)
                        ->EstimateTotal($this->estimate->total)
                        ->EstimateDate($this->estimate->date)
                        ->EstimateTerms($this->estimate->terms)
                        ->EstimateAddHeader(isset($this->estimate->header) ? $this->estimate->header : 0)
                        ->EstimateAddFooter (isset($this->estimate->footer) ? $this->estimate->footer : 0)
                        ->EstimateHeader($branding->header)
                        ->EstimateFooter($branding->footer);

        //dd($this->estimate->header . '-' . $this->estimate->footer);

        //dd($estimateItem);

        $now = Carbon::now();
        $unique_code = $now->format('YmdHi');
        $file_name = 'Estimate-' . $this->customer->fullName() . '-' . $unique_code . '.pdf';

        $pdfrooms = [];
        foreach($this->tableArray as $room){
            //dd($this->estimate->id . " " . $room['room_id']);

            $workitems = EstimateDetail::where([
                ['estimate_id', $this->estimate->id],
                ['room_id', $room['room_id']],
            ])->get();

            foreach($workitems as $item){

                $pdfitems[] = [
                    (new PDFEstimateDetailsItem())
                        ->WorkitemName($item['name'])
                        ->WorkitemDescription($item['description'])
                        ->WorkitemRate($item['rate'])
                        ->WorkitemUnit($item['unit'])
                        ->WorkitemQuantity($item['quantity'])
                        ->WorkitemTotal($item['total'])
                ];
            }


            $pdfrooms[] = [
                (new PDFRoomItem())->roomTitle($room['roomName'])->roomTotal($room['roomTotal'])->roomWorkitems($pdfitems)
            ];

            unset($pdfitems);
         }

         //dd($logo_url);

        $invoice = PDFEstimatePDF::make('Estimate')
            ->series('BIG')
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($pro)
            ->buyer($customer)
            ->date(now()->subWeeks(3))
            ->dateFormat('d/m/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($file_name)
            //->addItems($items)
            ->addRooms($pdfrooms)
            ->addEstimateItem($pdfEstimateItem)
            ->notes($this->estimate->terms)
            //->logo(public_path('vendor/invoices/sample-logo.png'))
            ->logo($logo_url)
            // You can additionally save generated invoice to configured disk
            ->save('public');

        $link = $invoice->url();
        // Then send email to party with link
        //dd($link);
        //dd($customer->name);
        return response()->streamDownload(function () use($invoice) {
            echo  $invoice->stream();
        }, $file_name);
    }

    public function deleteRoom($key){
        //dd($key);
        $rid = $this->tableArray[$key]['room_id'];
        //dd($rid);

        $estimateDetaisToBeDeleted = EstimateDetail::where(
            ['estimate_id' => $this->estimate->id,
            'room_id'   => $rid,
            ])->get();

        $estimateDetaisToBeDeleted->each->delete();

        $this->estimate_total = $this->estimate_total - $this->tableArray[$key]['roomTotal'];
        $this->estimate->total = $this->estimate_total;

        unset($this->tableArray[$key]);
        $this->tableArray = array_values($this->tableArray);
    }
    // protected function initListsForFields(): void
    // {
    //     $this->listsForFields['customer'] = Customer::pluck('first_name', 'id')->toArray();
    // }
}
