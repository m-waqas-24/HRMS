<?php

namespace Database\Seeders;

use App\Models\Admin\Trainer;
use App\Models\AllowanceOption;
use App\Models\Asset;
use App\Models\DeductionOption;
use App\Models\LoanOption;
use App\Models\PaySlipOption;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = collect([
            ['name' => 'Employee of the Month Award', 'created_by' => 2],
            ['name' => 'Work Anniversary Award', 'created_by' => 2],
            ['name' => 'Teamwork Award', 'created_by' => 2],
            ['name' => 'Sales Award', 'created_by' => 2],
            ['name' => 'Most Creative Award', 'created_by' => 2],
            ['name' => 'Leadership Award', 'created_by' => 2],
            ['name' => 'Character Award', 'created_by' => 2],
            ['name' => 'Innovation Award', 'created_by' => 2],
            ['name' => 'Customer Service Award', 'created_by' => 2],
            ['name' => 'Top Performer Award', 'created_by' => 2],
        ]);

        $types->each(function($type){
            Type::insert($type);
        });

        Trainer::create([
            'company_id' => 1,
            'branch_id' => 1,
            'name' => 'Test',
            'contact' => 0000000,
            'email' => 'testtt@test.com',
            'expertise' => 'Test',
            'created_by' => 2,
        ]);

        Type::create([
            'name' => 'Job Training',
            'created_by' => 2,
        ]);

        Asset::create([
            'name' => 'Mouse',
            'total_asset' => 20,
            'assigned' => 20,
            'free' => 20,
            'created_by' => 2,
        ]);
        Asset::create([
            'name' => 'Keyboard',
            'total_asset' => 20,
            'assigned' => 20,
            'free' => 20,
            'created_by' => 2,
        ]);

        PaySlipOption::create([
            'name' => 'Monthly',
            'created_by' => 2,
        ]);

        PaySlipOption::create([
            'name' => 'Weekly',
            'created_by' => 2,
        ]);

        AllowanceOption::create([
            'name' => 'HRA',
            'created_by' => 2,
        ]);

        DeductionOption::create([
            'name' => 'Absent',
            'created_by' => 2,
        ]);

        LoanOption::create([
            'name' => 'Medical',
            'created_by' => 2,
        ]);
        
    }
}
