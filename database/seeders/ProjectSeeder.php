<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada data klien dan pengguna terlebih dahulu
        $clients = Client::all();
        $users = User::where('role', 'ProjectManager')->get();

        // Jika tidak ada klien atau pengguna, hentikan seeding
        if ($clients->isEmpty() || $users->isEmpty()) {
            $this->command->warn('No clients or project managers found. Please seed clients and users first.');
            return;
        }

        // Buat 10 data proyek
        foreach (range(1, 10) as $index) {
            Project::create([
                'project_name' => 'Project ' . $index, // Nama proyek
                'cost' => rand(1000, 100000), // Biaya proyek antara 1000 hingga 100000
                'complexity' => ['Low', 'Medium', 'High'][array_rand(['Low', 'Medium', 'High'])], // Kompleksitas
                'status' => ['notstarted', 'onprogress', 'pending', 'canceled'][array_rand(['notstarted', 'onprogress', 'pending', 'canceled'])], // Status
                'description' => 'This is a description for Project ' . $index, // Deskripsi proyek
                'file_workorder' => Str::random(10) . '.pdf', // Nama file acak
                'start_date' => now()->subDays(rand(1, 30)), // Tanggal mulai antara 1-30 hari yang lalu
                'end_date' => now()->addDays(rand(30, 90)), // Tanggal selesai antara 30-90 hari ke depan
                'id_user' => $users->random()->id_user, // Pilih pengguna secara acak
                'id_client' => $clients->random()->id_client, // Pilih klien secara acak
            ]);
        }
    }
}
