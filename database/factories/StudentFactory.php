<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                $i = Student::max('user_id');

                return $i + 2;
            },
            'nisn' => $this->faker->randomNumber(9) . $this->faker->randomNumber(7),
            'nik' => $this->faker->randomNumber(9) . $this->faker->randomNumber(7),
            'first_name' => function () {
                $firstName = [null];
                $i = Student::max('student_id');

                for ($x = 0; $x < 5; $x++) {
                    array_push($firstName, 'Dummy');
                }

                return $firstName[$i + 1];
            },
            'last_name' => function () {
                $lastName = [null, 'Student'];
                $i = Student::max('student_id');

                return $lastName[$i + 1];
            },
            'father_name' => $this->faker->name,
            'mother_name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'phone' => $this->faker->numerify('#############'),
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date,
            'date_school_now' => $this->faker->date,
            'address' => $this->faker->address,
            'religion' => "islam",
            'school_origin' => "assalaam",
            'school_now' => "unesa",
            'parent_address' => $this->faker->address,
            'mother_profession' => "IRT",
            'father_profession' => "Direktur",
            'mother_education' => "S1",
            'father_education' => "S2",
            'family_name' => $this->faker->name,
            'family_address' => $this->faker->address,
            'family_profession' => "Manajer",
            'image' => null,
        ];
    }
}
