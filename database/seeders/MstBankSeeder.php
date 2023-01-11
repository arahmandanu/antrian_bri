<?php

namespace Database\Seeders;

use App\Models\MstBank;
use Illuminate\Database\Seeder;

class MstBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MstBank::factory()->times(30)->create();
    }
}
