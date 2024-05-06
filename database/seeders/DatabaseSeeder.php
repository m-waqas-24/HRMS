<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(DesignationSeeder::class);
        $this->call(ContractSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(GiftSeeder::class);
        $this->call(CandidateStatus::class);
        $this->call(TerminationType::class);
        $this->call(AssetStatusSeeder::class);
        $this->call(LeaveStatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(MonthSeeder::class);
        
        $this->call(AccountCategoryTypeSeeder::class);
        $this->call(DebtTypeSeeder::class);
        $this->call(AccountPermissionSeeder::class);
    }
}
