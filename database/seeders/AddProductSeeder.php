<?php

namespace Database\Seeders;

use App\Models\MasterProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'BRITAMA (RP)',
                'display_number' => 1,
                'show' => true,
            ],
            [
                'name' => 'BRITAMA (USD)',
                'display_number' => 2,
                'show' => true,
            ],
            [
                'name' => 'GIRO (RP)',
                'display_number' => 3,
                'show' => true,
            ],
            [
                'name' => 'SIMPEDES',
                'display_number' => 4,
                'show' => true,
            ],
            [
                'name' => 'DEPOSITO',
                'display_number' => 5,
                'show' => true,
            ],
            [
                'name' => 'TABUNGANKU',
                'display_number' => 6,
                'show' => true,
            ],
            [
                'name' => 'PENJAMINAN (RP)',
                'display_number' => 7,
                'show' => true,
            ],
            [
                'name' => 'PENJAMINAN (USD)',
                'display_number' => 8,
                'show' => true,
            ],
        ];

        $detailProduct = [
            [
                'value' => '500 RIBU - 5 JUTA',
                'suku_bunga' => '3 %',
                'display_number' => 1,
            ],
            [
                'value' => '> 5 JUTA - 50 JUTA',
                'suku_bunga' => '14 %',
                'display_number' => 2,
            ],
            [
                'value' => '> 50 JUTA - 100 JUTA',
                'suku_bunga' => '15 %',
                'display_number' => 3,
            ],
            [
                'value' => '> 100 JUTA - 1 MILYAR',
                'suku_bunga' => '24 %',
                'display_number' => 4,
            ],
            [
                'value' => '> 1 MILYAR',
                'suku_bunga' => '30 %',
                'display_number' => 5,
            ]
        ];

        foreach ($data as $key => $value) {
            $masterProduct = MasterProduct::create($value);
            foreach ($detailProduct as $data) {
                $masterProduct->productDetails()->create($data);
            }
        }
    }
}
