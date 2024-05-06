<?php

namespace Database\Seeders;

use App\Models\LeaveStatus;
use Illuminate\Database\Seeder;

class LeaveStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = collect([
            ['name' => 'Pending'],
            ['name' => 'Approved'],
            ['name' => 'Reject'],
        ]);

        $status->each(function($sta){
            LeaveStatus::insert($sta);
        });
    }
}
