<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AccountPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accPermissions = [
            [
                'name' => 'manage categories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create categories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'edit categories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'delete categories',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'manage banks',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create banks',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'edit banks',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'delete banks',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'manage bank-accounts',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create bank-accounts',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'edit bank-accounts',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'delete bank-accounts',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'manage balance-transfers',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create balance-transfers',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'manage debts-loans',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create debts-loans',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'edit debts-loans',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'delete debts-loans',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create borrow-more',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create repay',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create lend-more',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create debt-collection',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'manage incomes',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create incomes',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'edit incomes',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'delete incomes',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],  
            [
                'name' => 'manage expenses',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'create expenses',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'edit expenses',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],
            [
                'name' => 'delete expenses',
                'guard_name' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'mod_id' => 2,
            ],  

        ];

        Permission::insert($accPermissions);
    }
}
