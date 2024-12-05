<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('event_services')->insert([
            [
                'service_provider_id' => 3,
                'title' => 'Wedding Catering',
                'description' => 'Provide premium catering services for weddings with a selection of gourmet dishes.',
                'rate' => 5000,
                'status' => 'available',
                'scheduled_date' => '2024-12-25',
                'available_until' => '2024-12-24',
                'assigned_to' => 'John Doe',
                'location' => '123 Wedding St, Love City',
                'special_requests' => 'Vegetarian options and gluten-free desserts.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_provider_id' => 3,
                'title' => 'Birthday Party Decorations',
                'description' => 'Provide themed decorations for birthday parties, including balloons, banners, and table settings.',
                'rate' => 1500,
                'status' => 'in-progress',
                'scheduled_date' => '2024-12-20',
                'available_until' => '2024-12-19',
                'assigned_to' => 'Jane Smith',
                'location' => '456 Party Ave, Celebration Town',
                'special_requests' => 'Blue and gold color theme.',
                'is_featured' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_provider_id' => 3,
                'title' => 'Corporate Event Management',
                'description' => 'Full-service event planning for corporate meetings and conferences.',
                'rate' => 10000,
                'status' => 'completed',
                'scheduled_date' => '2024-11-15',
                'available_until' => '2024-11-10',
                'assigned_to' => 'Corporate Team',
                'location' => '789 Business Rd, Enterprise City',
                'special_requests' => 'Projector setup and high-speed internet.',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
