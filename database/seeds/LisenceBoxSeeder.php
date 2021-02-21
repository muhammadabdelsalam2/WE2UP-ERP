<?php

use Illuminate\Database\Seeder;

class LisenceBoxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('lisenceBox')->insert([
            'id'=>1,
            'lisence'=>0,
            'client_name'=>'Default',
            
            ]);
    }
}
