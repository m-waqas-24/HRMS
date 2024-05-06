<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contractType  = collect([
            [
                'name' => 'Temporary',
                'created_by' => 2,
            ],
            [
                'name' => 'Permanent',
                'created_by' => 2,
            ],
            [
                'name' => 'Internship',
                'created_by' => 2,
            ],
        ]);

        $contractType->each(function($type){
            Contract::insert($type);
        });
    }
}
