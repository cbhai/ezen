<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $created_at = Carbon::now()->format('Y-m-d H:i:s');
        //admin
        //pro
        //owner
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@cbq.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at' => $created_at,
            ],
            [
                'id'             => 2,
                'name'           => 'Nitin Contractor',
                'email'          => 'pro@cbq.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at' => $created_at,
            ],
            // [
            //     'id'             => 3,
            //     'name'           => 'R K Laxman',
            //     'email'          => 'owner@cbq.com',
            //     'password'       => bcrypt('password'),
            //     'remember_token' => null,
            //     'created_at' => $created_at,
            // ],
        ];

        User::insert($users);

        $userAdmin = User::find(1);
        $userAdmin->roles()->attach(1);

        $userPro = User::find(2);
        $userAdmin->roles()->attach(2);

        // $userOwner = User::find(3);
        // $userAdmin->roles()->attach(3);
    }
}
