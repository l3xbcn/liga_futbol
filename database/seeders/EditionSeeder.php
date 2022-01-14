<?php

namespace Database\Seeders;

use App\Models\Edition;
use Illuminate\Database\Seeder;

class EditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Edition::create([ 'id' => 87, 'start' => '2017-08-18', 'end' => '2018-05-20' ]); 
        Edition::create([ 'id' => 88, 'start' => '2018-08-17', 'end' => '2019-05-19' ]); 
        Edition::create([ 'id' => 89, 'start' => '2019-08-16', 'end' => '2020-07-19' ]); 
        Edition::create([ 'id' => 90, 'start' => '2020-09-12', 'end' => '2021-05-23' ]); 
        Edition::create([ 'id' => 91, 'start' => '2021-08-13', 'end' => '2022-05-22' ]);
    }
}
