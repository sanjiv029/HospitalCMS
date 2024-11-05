<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['name' => 'Cardiology', 'code' => 'CARD', 'description' => 'Responsible for the diagnosis and treatment of heart-related conditions.'],
            ['name' => 'Neurology', 'code' => 'NEUR', 'description' => 'Specializes in disorders of the nervous system, including the brain and spinal cord.'],
            ['name' => 'Pediatrics', 'code' => 'PED', 'description' => 'Provides healthcare for infants, children, and adolescents.'],
            ['name' => 'Dermatology', 'code' => 'DERM', 'description' => 'Focuses on skin-related issues, including acne, rashes, and other dermatological conditions.'],
            ['name' => 'Orthopedics', 'code' => 'ORTH', 'description' => 'Handles musculoskeletal system issues, including bones, joints, and muscles.'],
            ['name' => 'Gynecology', 'code' => 'GYNE', 'description' => 'Specializes in women’s reproductive health, pregnancy, and childbirth.'],
            ['name' => 'Ophthalmology', 'code' => 'OPHTH', 'description' => 'Deals with the diagnosis and treatment of eye disorders.'],
            ['name' => 'Oncology', 'code' => 'ONCO', 'description' => 'Focused on the treatment of cancer and related conditions.'],
            ['name' => 'Psychiatry', 'code' => 'PSYCH', 'description' => 'Provides mental health care, including therapy and medication management for mental disorders.'],
            ['name' => 'Gastroenterology', 'code' => 'GAST', 'description' => 'Deals with digestive system issues, including the stomach, liver, and intestines.'],
            ['name' => 'ENT', 'code' => 'ENT', 'description' => 'Focused on ear, nose, and throat conditions and treatments.'],
        ];

        foreach ($departments as $department) {
            \App\Models\Department::create($department);
        }
    }
}

