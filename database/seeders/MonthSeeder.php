<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $monthsnName  = collect([
            [
                'name' => 'January',
            ],
            [
                'name' => 'February',
            ],
            [
                'name' => 'March',
            ],
            [
                'name' => 'April',
            ],
            [
                'name' => 'May',
            ],
            [
                'name' => 'June',
            ],
            [
                'name' => 'July',
            ],
            [
                'name' => 'August',
            ],
            [
                'name' => 'September',
            ],
            [
                'name' => 'October',
            ],
            [
                'name' => 'November',
            ],
            [
                'name' => 'December',
            ],
        ]);

        $monthsnName->each(function($type){
            Month::insert($type);
        });
    }
}
