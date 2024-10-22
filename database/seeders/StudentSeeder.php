<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student; // Assuming your model is named Student
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();

        $municipalities = ['Pagadian', 'Aurora', 'Dumingag', 'Molave', 'San Pablo', 'San Miguel'];
        $provinces = 'Zamboanga del Sur';
        $region = 'Region IX';

        foreach(range(1, 1000) as $index) { // Insert 50 records as an example
            Student::create([
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,  // You can also use $faker->firstName for a random middle name
                'last_name' => $faker->lastName,
                'course_id' => $faker->randomElement([1, 2, 3]),
                'address' => null,
                'municipality' => $faker->randomElement($municipalities),
                'province' => $provinces,
                'region' => $region,
                'latitude' => $faker->latitude(7.7, 8.0),
                'longitude' => $faker->longitude(123.0, 124.0),
                'campus_id' => $faker->randomElement([1, 2, 3]),
                'year' => $faker->numberBetween(1, 4), // Assuming 4-year courses
                'status' => $faker->randomElement(['active', 'inactive', 'graduated']),
                'scholarship_id' => $faker->randomElement([1, 2, 3]),
            ]);
        }
    }
}
