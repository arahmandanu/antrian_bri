<?php

namespace Database\Seeders;

use App\Models\UnitCode;
use Illuminate\Database\Seeder;

class UnitCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $code = [
            ['key' => 'A', 'name' => 'TELLER'],
            ['key' => 'B', 'name' => 'Customer Service']
        ];

        $transactions = collect([
            [
                'code' => '1111',
                'name' => 'SETOR TELLER',
                'UnitService' => 'A',
            ],
            [
                'code' => '1112',
                'name' => 'PENGAMBILAN TELLER',
                'UnitService' => 'A',
            ],
            [
                'code' => '1113',
                'name' => 'KLIRING',
                'UnitService' => 'A',
            ],
            [
                'code' => '1114',
                'name' => 'TRANSFER VIA TELLER',
                'UnitService' => 'A',
            ],
            [
                'code' => '1115',
                'name' => 'LAIN LAIN',
                'UnitService' => 'A',
            ],

            [
                'code' => '2226',
                'name' => 'KLOMPLAIN NASABAH',
                'UnitService' => 'B',
            ],
            [
                'code' => '2225',
                'name' => 'BLOKIR REKENING',
                'UnitService' => 'B',
            ],
            [
                'code' => '2224',
                'name' => 'GANTI ATM',
                'UnitService' => 'B',
            ],
            [
                'code' => '2223',
                'name' => 'BUKA DEPOSITO',
                'UnitService' => 'B',
            ],
            [
                'code' => '2222',
                'name' => 'BUKA INTERNET BANKING',
                'UnitService' => 'B',
            ],
            [
                'code' => '2221',
                'name' => 'BUKA TABUNGAN',
                'UnitService' => 'B',
            ],
            [
                'code' => '2220',
                'name' => 'LAIN-LAIN',
                'UnitService' => 'B',
            ],
        ]);

        foreach ($code as $key => $value) {
            $unitCode = UnitCode::create([
                'code' => $value['key'],
                'name' => $value['name'],
            ]);

            $filtered = $transactions->where('UnitService', $value['key'])->toArray();
            foreach ($filtered as $key => $value) {
                unset($value['UnitService']);
                $unitCode->transactions()->create($value);
            }
        }
    }
}
