<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TaskersTableSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Plumbing', 'Electrical', 'Cleaning', 'Moving', 'Handyman', 'Tiler', 'Painter'];
        $services = ['Home Repair', 'Installation', 'Deep Cleaning', 'Furniture Assembly', 'Tile Installation', 'Interior Painting'];
        
        $taskers = [];
        
        for ($i = 1; $i <= 20; $i++) {
            $firstName = $this->getRandomFirstName();
            $lastName = $this->getRandomLastName();
            
            $taskers[] = [
                'nom' => $lastName,
                'prenom' => $firstName,
                'CIN' => 'AB' . rand(100000, 999999),
                'category_name' => $categories[array_rand($categories)],
                'service_name' => $services[array_rand($services)],
                'image' => 'taskers/tasker' . rand(1, 10) . '.jpg',
                'adresse' => $this->getRandomAddress(),
                'telephone' => '06' . rand(10000000, 99999999),
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'updated_at' => Carbon::now()->subDays(rand(0, 100)),
            ];
        }
        
        DB::table('taskers')->insert($taskers);
    }
    
    private function getRandomFirstName()
    {
        $firstNames = ['Mohamed', 'Ahmed', 'Fatima', 'Amina', 'Youssef', 'Hassan', 'Samira', 'Karim', 'Nadia', 'Khalid'];
        return $firstNames[array_rand($firstNames)];
    }
    
    private function getRandomLastName()
    {
        $lastNames = ['Alaoui', 'Benjelloun', 'El Mansouri', 'Oufkir', 'Belhaj', 'Cherkaoui', 'Zahir', 'Bennis', 'Daoudi', 'Fassi'];
        return $lastNames[array_rand($lastNames)];
    }
    
    private function getRandomAddress()
    {
        $streets = ['Rue Mohammed V', 'Avenue Hassan II', 'Boulevard Mohamed VI', 'Rue Palestine', 'Avenue des FAR'];
        $cities = ['Casablanca', 'Rabat', 'Marrakech', 'Fes', 'Tangier'];
        return rand(1, 200) . ' ' . $streets[array_rand($streets)] . ', ' . $cities[array_rand($cities)];
    }
}