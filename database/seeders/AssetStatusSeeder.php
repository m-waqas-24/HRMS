<?php

namespace Database\Seeders;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assetStatus  = collect([
            [
                'name' => 'Approved',
            ],
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Returned',
            ],
            [
                'name' => 'Damaged',
            ],
            [
                'name' => 'Lost',
            ],
        ]);

        $assetStatus->each(function($type){
            AssetStatus::insert($type);
        });
    }
}
