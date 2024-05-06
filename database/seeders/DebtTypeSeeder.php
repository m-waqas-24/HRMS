<?php

namespace Database\Seeders;

use App\Models\Account\DebtType;
use Illuminate\Database\Seeder;

class DebtTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DebtType::create([
            'name' => 'Lend',
        ]);
        DebtType::create([
            'name' => 'Borrow',
        ]);
        DebtType::create([
            'name' => 'Repayment',
        ]);
        DebtType::create([
            'name' => 'Debt Collection',
        ]);
    }
}
