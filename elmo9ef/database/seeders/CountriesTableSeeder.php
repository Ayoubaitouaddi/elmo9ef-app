<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['name' => 'United States', 'code' => 'US', 'phone_code' => '+1'],
            ['name' => 'Andorra', 'code' => 'AD', 'phone_code' => '+376'],
            ['name' => 'Maroc', 'code' => 'MA', 'phone_code' => '+212'],
            ['name' => 'Austria', 'code' => 'AT', 'phone_code' => '+43'],
            ['name' => 'Belgium', 'code' => 'BE', 'phone_code' => '+32'],
            ['name' => 'Canada', 'code' => 'CA', 'phone_code' => '+1'],
            ['name' => 'Czechia', 'code' => 'CZ', 'phone_code' => '+420'],
            // Ajoutez d'autres pays ici
        ];

        DB::table('countries')->insert($countries);
    }
}