<?php

use Illuminate\Database\Seeder;
use App\Color;
class colorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Color::insert([
            [
                'name' => 'red'
                
            ],
            [
                'name' => 'Aqua'
            ],
            [
                'name' => 'green'
            ]
        
        ]);
    }
}
