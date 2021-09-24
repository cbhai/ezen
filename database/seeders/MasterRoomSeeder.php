<?php

namespace Database\Seeders;

use App\Models\MasterRoom;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now()->format('Y-m-d H:i:s');

        $rooms = [
            [
                'name'           => 'Kitchen',
                'description'    => 'Kitchen area of the house. Covers modular kitchen, platform etc...',
                'created_at'     => $created_at,
                // 'owner_id'        => '1',
            ],
            [
                'name'           => 'Living room',
                'description'    => 'Living room area. Covers Furniture, Seating area, TV unit etc...',
                'created_at'     => $created_at,
                //'owner_id'        => '1',
            ],
            [
                'name'           => 'Bedroom',
                'description'    => 'Bedroom. Covers furniture - mainly bed, wardrobe etc...',
                'created_at'     => $created_at,
                //'owner_id'        => '1',
            ],
            [
                'name'           => 'Bathroom',
                'description'    => 'Bathroom area. Wash basin, WC area, Shower etc...',
                'created_at'     => $created_at,
                //'owner_id'        => '1',
            ],
        ];

        MasterRoom::insert($rooms);

        //Nitin-TO-DO
        //have to add more default rooms like office, blacony, lobby, master bedroom, toilet,
        //entrance, repair items,
        //kids room
        //storage room
        //utility area
        //
        //Also how does existing user get new rooms added in master? THis job has to be handled

    }
}
