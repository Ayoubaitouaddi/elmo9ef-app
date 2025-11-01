<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Category; // Add this line to import the Category model
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $servicesByCategory = [
            'Handyman' => [
                'Tiler', 'Painter', 'Mover', 'Cleaner', 'Carpenter', 
                'Plumber', 'Electrician', 'Builder', 'Appliance Repair Technician',
                'Mechanic', 'Blacksmith', 'Marble and Granite', 'Glass Installer',
                'Air Conditioning Technician'
            ],
            'Moving Services' => [
                'Help Moving', 'Truck Assisted Help Moving', 'Packing Services & Help', 
                'Unpacking Services', 'Heavy Lifting', 'Local Movers', 'Junk Pickup', 
                'Furniture Movers', 'One Item Movers', 'Storage Unit Moving', 
                'Couch Removal', 'Mattress Pick-Up & Removal', 'Furniture Removal', 
                'Pool Table Movers', 'Appliance Removal', 'Heavy Furniture Moving', 
                'Rearrange Furniture', 'Full Service Help Moving', 'In-Home Furniture Movers'
            ],
            'Mounting & Installation' => [
                'Wall Mounting', 'TV Mounting', 'Install Shelves, Rods & Hooks', 
                'Ceiling Fan Installation', 'Install Blinds & Window Treatments', 
                'Hang Art, Mirror & Decor', 'General Mounting', 'Hang Christmas Lights'
            ],
            'Furniture Assembly' => [
                'Furniture Assembly', 'Patio Furniture Assembly', 'Desk Assembly', 
                'Dresser Assembly', 'Bed Assembly', 'Bookshelf Assembly', 'Couch Assembly', 
                'Chair Assembly', 'Wardrobe Assembly', 'Table Assembly', 'Disassemble furniture'
            ],
            'Cleaning' => [
                'House Cleaning Services', 'Deep Cleaning', 'Disinfecting Services', 
                'Move In Cleaning', 'Move Out Cleaning', 'Vacation Rental Cleaning', 
                'Carpet Cleaning Service', 'Garage Cleaning', 'One Time Cleaning Services', 
                'Car Washing', 'Laundry Help', 'Pressure Washing', 'Spring Cleaning'
            ]
        ];

        foreach ($servicesByCategory as $categoryName => $services) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($services as $serviceName) {
                Service::create([
                    'name' => $serviceName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
