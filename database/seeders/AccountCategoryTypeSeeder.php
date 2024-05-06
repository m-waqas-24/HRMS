<?php

namespace Database\Seeders;

use App\Models\Account\AccountCategoryType;
use Illuminate\Database\Seeder;

class AccountCategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountCategoryType::create([
            'name' => 'Income',
        ]);
        AccountCategoryType::create([
            'name' => 'Expense',
        ]);
    }
}
