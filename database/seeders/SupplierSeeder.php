<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [

            [
                'nama' => 'PT Semen Indonesia',
                'telepon' => '081234567890',
                'email' => 'semenindonesia@gmail.com',
                'alamat' => 'Jl Raya Industri No 10',
                'kota' => 'Bandung',
                'nama_sales' => 'Budi',
            ],

            [
                'nama' => 'CV Besi Jaya',
                'telepon' => '082233445566',
                'email' => 'besijaya@gmail.com',
                'alamat' => 'Jl Ahmad Yani No 22',
                'kota' => 'Bogor',
                'nama_sales' => 'Andi',
            ],

            [
                'nama' => 'PT Keramik Nasional',
                'telepon' => '081122334455',
                'email' => 'keramiknasional@gmail.com',
                'alamat' => 'Jl Industri Keramik No 5',
                'kota' => 'Tangerang',
                'nama_sales' => 'Rina',
            ],

            [
                'nama' => 'Toko Cat Makmur',
                'telepon' => '085566778899',
                'email' => 'catmakmur@gmail.com',
                'alamat' => 'Jl Raya Bogor No 18',
                'kota' => 'Jakarta',
                'nama_sales' => 'Dewi',
            ],

            [
                'nama' => 'PT Pipa Nusantara',
                'telepon' => '087788990011',
                'email' => 'pipanusantara@gmail.com',
                'alamat' => 'Jl Pembangunan No 7',
                'kota' => 'Bekasi',
                'nama_sales' => 'Agus',
            ],

        ];

        foreach ($suppliers as $supplier) {

            Supplier::firstOrCreate(
                [
                    'nama' => $supplier['nama']
                ],
                $supplier
            );

        }
    }
}