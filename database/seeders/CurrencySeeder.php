<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            [
                'name' => 'USD',
                'url' => 'USD.png',
                'jual' => '15.410,00',
                'beli' => '15.740,00',
                'show' => true,
                'display_number' => 1,
            ],
            [
                'name' => 'CAD',
                'url' => 'CAD.png',
                'jual' => '11.302,67',
                'beli' => '11.502,67',
                'show' => true,
                'display_number' => 2,
            ],
            [
                'name' => 'AUD',
                'url' => 'AUD.png',
                'jual' => '10.319,07',
                'beli' => '10.519,07',
                'show' => true,
                'display_number' => 3,
            ],
            [
                'name' => 'SGD',
                'url' => 'SGD.png',
                'jual' => '11.708,75',
                'beli' => '12.108,75',
                'display_number' => 4,
                'show' => true,
            ],
            [
                'name' => 'HKD',
                'url' => 'HKD.png',
                'jual' => '1.926,38',
                'beli' => '2.076,38',
                'display_number' => 5,
                'show' => true,
            ],
            [
                'name' => 'GBP',
                'url' => 'GBP.png',
                'jual' => '20.087,27',
                'beli' => '20.327,27',
                'display_number' => 6,
                'show' => true,
            ],
            [
                'name' => 'CHF',
                'url' => 'CHF.png',
                'jual' => '17.964,28',
                'beli' => '18.164,28',
                'display_number' => 7,
                'show' => true,
            ],
            [
                'name' => 'EUR',
                'url' => 'EUR.png',
                'jual' => '17.113,95',
                'beli' => '17.313,95',
                'display_number' => 8,
                'show' => true,
            ],
            [
                'name' => 'SAR',
                'url' => 'SAR.png',
                'jual' => '4.054,45',
                'beli' => '4.404,45',
                'display_number' => 9,
                'show' => true,
            ],
            [
                'name' => 'CNY',
                'url' => 'CNY.png',
                'jual' => '2.101,79',
                'beli' => '2.271,79',
                'display_number' => 10,
                'show' => true,
            ],
            [
                'name' => 'MYR',
                'url' => 'MYR.png',
                'jual' => '3.485,10',
                'beli' => '3.610,10',
                'display_number' => 11,
                'show' => true,
            ],
            [
                'name' => 'THB',
                'url' => 'THB.png',
                'jual' => '413,17',
                'beli' => '493,17',
                'display_number' => 12,
                'show' => true,
            ],
            [
                'name' => 'JPY',
                'url' => 'JPY.png',
                'jual' => '102,14',
                'beli' => '111,11',
                'display_number' => 13,
                'show' => true,
            ],
            [
                'name' => 'KRW',
                'url' => 'KRW.png',
                'jual' => '6,70',
                'beli' => '16,70',
                'display_number' => 14,
                'show' => true,
            ],
            [
                'name' => 'PGK',
                'url' => 'PGK.png',
                'jual' => '3.744,31',
                'beli' => '3.884,31',
                'display_number' => 15,
                'show' => true,
            ],
            [
                'name' => 'NZD',
                'url' => 'NZD.png',
                'jual' => '9.373,53',
                'beli' => '9.573,53',
                'display_number' => 16,
                'show' => true,
            ],
            [
                'name' => 'BND',
                'url' => 'BND.png',
                'jual' => '11.808,75',
                'beli' => '12.008,75',
                'display_number' => 17,
                'show' => true,
            ],
            [
                'name' => 'AED',
                'url' => 'AED.png',
                'jual' => '4.159,08',
                'beli' => '4.344,08',
                'display_number' => 18,
                'show' => true,
            ],
            [
                'name' => 'INR',
                'url' => 'INR.png',
                'jual' => '165,98',
                'beli' => '205,98',
                'display_number' => 19,
                'show' => true,
            ],
            [
                'name' => 'PHP',
                'url' => 'PHP.png',
                'jual' => '225,06',
                'beli' => '325,06',
                'display_number' => 20,
                'show' => true,
            ],
            [
                'name' => 'VND',
                'url' => 'VND.png',
                'jual' => '0,37',
                'beli' => '0,92',
                'display_number' => 21,
                'show' => true,
            ],
            [
                'name' => 'TWD',
                'url' => 'TWD.png',
                'jual' => '337,26',
                'beli' => '524,26',
                'display_number' => 22,
                'show' => true,
            ],
            [
                'name' => 'NOK',
                'url' => 'NOK.png',
                'jual' => '1.480,30',
                'beli' => '1.489,63',
                'display_number' => 23,
                'show' => true,
            ],
            [
                'name' => 'DKK',
                'url' => 'DKK.png',
                'jual' => '124.456,78',
                'beli' => '124.456,78',
                'display_number' => 24,
                'show' => false,
            ],
            [
                'name' => 'SEK',
                'url' => 'SEK.png',
                'jual' => '1.511,42',
                'beli' => '1.520,70',
                'display_number' => 25,
                'show' => true,
            ],
        ]);
    }
}
