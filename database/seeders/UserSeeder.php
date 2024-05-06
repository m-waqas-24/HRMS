<?php

namespace Database\Seeders;

use App\Models\Admin\Trainer;
use App\Models\Branch;
use App\Models\Company;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'type' => 'superadmin',
            'created_by' => 0,
        ]);

    
        Company::create([
            'name' => 'PFTP',
            'created_by' => 2,
        ]);

        Branch::create([
            'name' => 'Model Town',
            'company_id' => 1,
            'created_by' => 2,
        ]);

        Status::create([
            'name' => 'Casual Leave',
            'created_by' => 2,
        ]);
    }
}
