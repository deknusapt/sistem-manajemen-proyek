<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Material::insert([
            [
                'material_name' => 'Rackmount Server',
                'brandname' => 'SteelCo',
                'serial_number' => 'SC-001',
                'quantity' => 36,
                'availability' => 'Available',
            ],
            [
                'material_name' => 'MikroTik Router',
                'brandname' => 'MikroTik',
                'serial_number' => 'MT-002',
                'quantity' => 50,
                'availability' => 'Available',
            ],
            [
                'material_name' => 'UTP Cable',
                'brandname' => 'WoodWorks',
                'serial_number' => 'WW-003',
                'quantity' => 200,
                'availability' => 'Available',
            ],
            [
                'material_name' => 'Fiber Optic Splicer',
                'brandname' => 'FOCut',
                'serial_number' => 'FO-004',
                'quantity' => 2,
                'availability' => 'Available',
            ],
            [
                'material_name' => 'OTDR Tester',
                'brandname' => 'FiberTech',
                'serial_number' => 'FT-005',
                'quantity' => 5,
                'availability' => 'Available',
            ],
        ]);
    }
}
