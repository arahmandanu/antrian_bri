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
        $code = ['cs', 'teller'];
        foreach ($code as $key => $value) {
            UnitCode::create([
                'code' => $value,
                'name' => "Unit {$key}",
            ]);
        }
    }
}
