<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Models\TrainingType;
use Illuminate\Database\Seeder;

class GiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gifts = collect([
            ['name' => 'Cash', 'created_by' => 2],
            ['name' => 'Momento', 'created_by' => 2],
            ['name' => 'Trophy', 'created_by' => 2],
            ['name' => 'Certificate', 'created_by' => 2],
            ['name' => 'Others', 'created_by' => 2],
        ]);

        $gifts->each(function($gift){
            Gift::insert($gift);
        });

        TrainingType::create([
            'name' => 'Job Training',
            'created_by' => 2,
        ]);
    }
}
