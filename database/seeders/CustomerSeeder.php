<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [

            [
                'nama' => 'Toko Maju Jaya',
                'telp' => '081234567890',
                'alamat' => 'Bogor',
            ],

            [
                'nama' => 'CV Bangun Bersama',
                'telp' => '082233445566',
                'alamat' => 'Jakarta',
            ],

            [
                'nama' => 'PT Konstruksi Hebat',
                'telp' => '081122334455',
                'alamat' => 'Depok',
            ],

            [
                'nama' => 'Toko Material Makmur',
                'telp' => '085566778899',
                'alamat' => 'Bekasi',
            ],

            [
                'nama' => 'Proyek Perumahan Sejahtera',
                'telp' => '087788990011',
                'alamat' => 'Tangerang',
            ],

        ];

        foreach ($customers as $customer) {

            Customer::create($customer);

        }
    }
}
