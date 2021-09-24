<?php

namespace Database\Seeders;

use App\Models\MasterWorkitem;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterWorkitemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created_at = Carbon::now()->format('Y-m-d H:i:s');

        //1 Kitchen
        //2 Living room
        //3 Bedroom
        //4 Bathroom

        $workitems = [
            [
                'room_id'       => 1,
                'name'          => 'Kitchen wall tiling',
                'description'   => 'Wall tiling using vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  90,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 1,
                'name'          => 'Kitchen Flooring',
                'description'   => 'Flooring with vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  100,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 2,
                'name'          => 'Living room wall tiling',
                'description'   => 'Living room using vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  110,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 2,
                'name'          => 'Living room Flooring',
                'description'   => 'Living room flooring with vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  120,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 3,
                'name'          => 'Bedroom wall tiling',
                'description'   => 'Bedroom Wall tiling using vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  90,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 3,
                'name'          => 'Bedroom  Flooring',
                'description'   => 'Bedroom Flooring with vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  105,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 4,
                'name'          => 'Bathroom Waterproofing',
                'description'   => ' Waterproofing with chemicals.',
                'unit'     =>  'rft',
                'rate'          =>  80,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
            [
                'room_id'       => 4,
                'name'          => 'Bathroom Flooring',
                'description'   => 'Bathroom flooring with vitrified tiles',
                'unit'     =>  'rft',
                'rate'          =>  95,
                'created_at'     => $created_at,
                //'owner_id' => 1
            ],
        ];

        //MasterWorkitem::insert($workitems);
        MasterWorkitem::insert($workitems);
    }
}
