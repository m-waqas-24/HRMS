<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = collect([
            [
                'name' => 'Academics',
            'created_by' => 2,
        ],
            ['name' => 'Graphics',
            'created_by' => 2,
        ],
            ['name' => 'Human Resources',
            'created_by' => 2,
        ],
        ['name' => 'Selling',
        'created_by' => 2,
        ],
        ['name' => 'Social Media',
        'created_by' => 2,
    ],
            ['name' => 'Videography',
            'created_by' => 2,
        ],
        
        ['name' => 'Web Development',
        'created_by' => 2,
    ],
        ]);

        $departments->each(function($department){
            Department::insert($department);
        });
    }
}
