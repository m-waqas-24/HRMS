<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = Department::all();

        $designations = collect([
            [
                'name' => 'Web Designer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Web Developer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Front-end Developer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Back-end Developer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Android Developer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Flutter Developer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Graphics Designer',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                 'created_by' => 2,
            ],
            [
                'name' => 'Operation Manager',
                'department_id' => $departments->firstWhere('name', 'Web Development')->id,
                'created_by' => 2,
            ],
        ]);

        $designations->each(function($designation){
            Designation::insert($designation);
        });
    }
}
