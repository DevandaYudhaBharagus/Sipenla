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

                return $i + 1;
            },
            'nisn' => $this->faker->randomNumber(9) . $this->faker->randomNumber(7),
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
            'address' => $this->faker->address,
        ];
    }
}
