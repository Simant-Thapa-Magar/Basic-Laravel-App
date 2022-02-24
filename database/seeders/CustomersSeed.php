<?php

namespace Database\Seeders;
use App\Models\Customer;

use Illuminate\Database\Seeder;


class CustomersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Customer::create([
            'id'=>1,
            'name'=>'Ram',
            'dob'=>date('Y-m-d',strtotime('1998-06-08')),
            'company'=>'nicetowork',
            'created_at' => date('Y-m-d h:i:s',strtotime('now')),
            'updated_at' => date('Y-m-d h:i:s',strtotime('now'))
        ]);

        Customer::create([
            'id'=>2,
            'name'=>'Shyam',
            'dob'=>date('Y-m-d',strtotime('1995-12-26')),
            'company'=>'readytowork',
            'created_at' => date('Y-m-d h:i:s',strtotime('now')),
            'updated_at' => date('Y-m-d h:i:s',strtotime('now'))
        ]);

        Customer::create([
            'id'=>3,
            'name'=>'Hari',
            'dob'=>date('Y-m-d',strtotime('1988-01-02')),
            'company'=>'workfromhome',
            'created_at' => date('Y-m-d h:i:s',strtotime('now')),
            'updated_at' => date('Y-m-d h:i:s',strtotime('now'))
        ]);
    }
}
