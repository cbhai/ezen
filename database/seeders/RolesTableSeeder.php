<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $created_at = Carbon::now()->format('Y-m-d H:i:s');
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
                'created_at' => $created_at,
            ],
            [
                'id'    => 2,
                'title' => 'Pro',
                'created_at' => $created_at,
            ],
            // [
            //      'id'    => 3,
            //      'title' => 'Owner',
            //      'created_at' => $created_at,
            // ],
        ];

        Role::insert($roles);
    }
}
