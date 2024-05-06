<?php

namespace Database\Seeders;

use App\Models\CandidateStatus as ModelsCandidateStatus;
use Illuminate\Database\Seeder;

class CandidateStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidateStatus  = collect([
            [
                'name' => 'Applied',
            ],
            [
                'name' => 'Phone Screen',
            ],
            [
                'name' => 'interview',
            ],
            [
                'name' => 'Hired',
            ],
            [
                'name' => 'Rejected',
            ],
        ]);

        $candidateStatus->each(function($type){
            ModelsCandidateStatus::insert($type);
        });
    }
}
