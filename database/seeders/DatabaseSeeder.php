<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Property;
use App\Models\Review;
use App\Models\ServiceCompany;
use App\Models\ServiceRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Crear usuarios de ejemplo
        foreach (range(1, 10) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'phone' => $faker->phoneNumber,
                'role' => $faker->randomElement(['landlord', 'service_company']),
            ]);
        }

        // Crear propiedades de ejemplo
        foreach (range(1, 20) as $index) {
            Property::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'address' => $faker->address,
                'city' => $faker->city,
                'comunidad' => $faker->state,
                'codigo_postal' => $faker->postcode,
            ]);
        }

        // Crear empresas de servicios de ejemplo
        foreach (range(1, 5) as $index) {
            ServiceCompany::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'company_name' => $faker->company,
                'description' => $faker->paragraph,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'website' => $faker->url,
                'service_type' => $faker->randomElement(['cleaning', 'construction', 'plumbing', 'electricity', 'general_renovation', 'other_services']),
            ]);
        }

        // Crear solicitudes de servicio de ejemplo
        foreach (range(1, 30) as $index) {
            ServiceRequest::create([
                'property_id' => Property::inRandomOrder()->first()->id,
                'company_id' => ServiceCompany::inRandomOrder()->first()->id,
                'description' => $faker->paragraph,
                'status' => $faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            ]);
        }

        // Crear reseñas de ejemplo
        foreach (range(1, 30) as $index) {
            $reviewedType = $faker->randomElement(['property', 'company']);
            $reviewedId = null;

            if ($reviewedType === 'property') {
                $reviewedId = Property::inRandomOrder()->first()->id;
            } else {
                $reviewedId = ServiceCompany::inRandomOrder()->first()->id;
            }

            Review::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'reviewed_id' => $reviewedId,
                'reviewed_type' => $reviewedType,
                'rating' => $faker->numberBetween(1, 5),
                'comment' => $faker->paragraph,
            ]);
        }
    }
}
