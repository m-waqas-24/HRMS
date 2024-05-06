<?php

namespace Database\Seeders;

use App\Models\TerminationType as ModelsTerminationType;
use Illuminate\Database\Seeder;

class TerminationType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = collect([
            ['name' => 'Behaviour', 'created_by' => 2],
            ['name' => 'Performance', 'created_by' => 2],
            ['name' => 'Attendance and Puncuality issue', 'created_by' => 2],
        ]);

        $types->each(function($type){
            ModelsTerminationType::insert($type);
        });
    }
}
