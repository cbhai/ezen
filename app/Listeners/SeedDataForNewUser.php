<?php

namespace App\Listeners;

use App\Models\MasterRoom;
use App\Models\MasterWorkitem;
use App\Models\Room;
use App\Models\Term;
use App\Models\Workitem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SeedDataForNewUser implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        //dd($event->user->id);
        $user_id =  $event->user->id;

        //$user_id = auth()->user()->id;
        //$created_at = CarbonPeriod::now()->format('Y-m-d H:i:s');

        //$rooms = array();
        foreach (MasterRoom::all() as $masterRoom) {

            $room = [
                'name'           => $masterRoom->name,
                'description'    => $masterRoom->description,
                'is_master'      => 1,
                'owner_id'       => $user_id,
                //'created_at'     => $created_at,
                //'user_id'        => $user_id,
            ];
            //$rooms[] = $room;
            //$newRoom = Room::insert($room);
            //dd($room);
            $newRoom = Room::create($room);
            $newRoomId = $newRoom->id;

            $workitemsFromMaster = MasterWorkitem::where('room_id', $masterRoom->id)->get();

            $workitems = array();

            foreach ($workitemsFromMaster as $masterWorkitem) {
                $newWorkitem = [
                    'name'           => $masterWorkitem->name,
                    'description'    => $masterWorkitem->description,
                    'unit'           =>  $masterWorkitem->unit,
                    'rate'           =>  $masterWorkitem->rate,
                    'is_master'      => 1,
                    'owner_id'       => $user_id,
                    'room_id'        => $newRoomId,
                    //'created_at'     => $created_at,
                    //'user_id'        => $user_id,

                ];
                $workitems[] = $newWorkitem;
            }
            Workitem::insert($workitems);
        }

        $t = "This estimate is not a contract or a bill. It is our best guess at the total price to complete the work stated above, based upon our initial inspection. <br>
        If prices changes or additional material and labour are required, we will inform you prior to proceeding with the work.<br>
        Water & Electricity will be provided by client <br>
        For keeping debris, place inside society premises will be provided by client <br>";

        Term::create([
            'terms' => $t,
            'owner_id' => $user_id,
        ]);
    }
}
