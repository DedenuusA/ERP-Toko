<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $units = [

            [
                'name' => 'Pieces',
                'code' => 'PCS',
            ],

            [
                'name' => 'Kilogram',
                'code' => 'KG',
            ],

            [
                'name' => 'Meter',
                'code' => 'M',
            ],

            [
                'name' => 'Batang',
                'code' => 'BTG',
            ],

            [
                'name' => 'Sak',
                'code' => 'SAK',
            ],

            [
                'name' => 'Dus',
                'code' => 'DUS',
            ],

            [
                'name' => 'Roll',
                'code' => 'ROLL',
            ],

            [
                'name' => 'Lembar',
                'code' => 'LBR',
            ],

            [
                'name' => 'Liter',
                'code' => 'L',
            ],

            [
                'name' => 'Kubik',
                'code' => 'M3',
            ],

            [
                'name' => 'Kaleng',
                'code' => 'KLG',
            ],

        ];

        foreach ($units as $unit) {

            Unit::firstOrCreate(
                [
                    'name' => $unit['name']
                ],
                [
                    'code' => $unit['code']
                ]
            );

        }
    }
}
