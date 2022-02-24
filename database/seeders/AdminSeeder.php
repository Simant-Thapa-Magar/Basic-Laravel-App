<?php

namespace Database\Seeders;
use App\Models\Administrator;

use Illuminate\Database\Seeder;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Administrator::create(
            [
                'id' => 1,
                'username' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => date('Y-m-d h:i:s',strtotime('now')),
                'updated_at' => date('Y-m-d h:i:s',strtotime('now'))
            ]
        );
    }
}
