<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Documentation;

class DocumentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Documentation::insert([
            [
                'doc_name' => 'Project Alpha Documentation',
                'description' => 'Initial documentation for Project Alpha.',
                'file_photos' => 'photos/project_alpha_1.jpg',
                'status' => 'Accepted',
                'date_submitted' => '2023-01-15',
                'id_project' => 1,
                'id_user' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doc_name' => 'Project Beta Documentation',
                'description' => 'Documentation for milestone 1 of Project Beta.',
                'file_photos' => 'photos/project_beta_1.jpg',
                'status' => 'Revision',
                'date_submitted' => '2023-02-10',
                'id_project' => 2,
                'id_user' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doc_name' => 'Project Gamma Documentation',
                'description' => 'Final documentation for Project Gamma.',
                'file_photos' => 'photos/project_gamma_final.jpg',
                'status' => 'Accepted',
                'date_submitted' => '2023-03-20',
                'id_project' => 3,
                'id_user' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doc_name' => 'Project Delta Documentation',
                'description' => 'Documentation for testing phase of Project Delta.',
                'file_photos' => 'photos/project_delta_testing.jpg',
                'status' => 'NeedReview',
                'date_submitted' => '2023-04-15',
                'id_project' => 4,
                'id_user' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'doc_name' => 'Project Epsilon Documentation',
                'description' => 'Initial setup documentation for Project Epsilon.',
                'file_photos' => 'photos/project_epsilon_setup.jpg',
                'status' => 'Revision',
                'date_submitted' => '2023-05-10',
                'id_project' => 5,
                'id_user' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}