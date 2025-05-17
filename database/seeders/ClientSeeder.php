<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 5) as $index) {
            Client::create([
                'client_fullname' => 'Client Fullname ' . $index, // Nama lengkap klien
                'company' => 'Company ' . $index, // Nama perusahaan
                'position' => 'Position ' . $index, // Posisi klien di perusahaan
                'address' => 'Address ' . $index, // Alamat klien
                'phone_number' => '0812345678' . $index, // Nomor telepon klien
                'email' => 'client' . $index . '@example.com', // Email klien
            ]);
        }
    }
}
