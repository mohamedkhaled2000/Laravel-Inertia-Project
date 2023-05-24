<?php

namespace Database\Factories;

use App\Models\ClassRooms;
use App\Models\Grade;
use App\Models\Nationality;
use App\Models\Parents;
use App\Models\Section;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            return [
                'name' => $this->faker->name(),
                'email' => $this->faker->unique()->safeEmail(),
                'password' => Hash::make('123123123'),
                'gender' => random_int(1,2),
                'nationality_id' => Nationality::inRandomOrder()->first(),
                'type_blood_id' => TypeBlood::inRandomOrder()->first(),
                'date_brith' => $this->faker->date(),
                'grade_id' => Grade::inRandomOrder()->first(),
                'class_room_id' => ClassRooms::inRandomOrder()->first(),
                'section_id' => Section::inRandomOrder()->first(),
                'parent_id' => Parents::inRandomOrder()->first(),
                'academic_year' => $this->faker->date('Y')
            ];
    }
}
