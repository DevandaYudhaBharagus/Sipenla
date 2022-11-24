<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                $i = Employee::max('user_id');

                return $i + 1;
            },
            'first_name' => function () {
                $firstName = [null];
                $i = Employee::max('employee_id');

                for ($x = 0; $x < 5; $x++) {
                    array_push($firstName, 'Dummy');
                }

                return $firstName[$i + 1];
            },
            'last_name' => function () {
                $lastName = [null,'Admin'];
                $i = Employee::max('employee_id');

                return $lastName[$i + 1];
            },
            'nik' => $this->faker->randomNumber(9) . $this->faker->randomNumber(7),
            'nuptk' => $this->faker->randomNumber(9) . $this->faker->randomNumber(7),
            'npsn' => $this->faker->randomNumber(9) . $this->faker->randomNumber(7),
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date,
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'address' => $this->faker->address,
            'phone' => $this->faker->numerify('#############'),
            'education' => 'sma',
            'family_name' => 'johan',
            'family_address' => $this->faker->address,
            'position' => 'manajer',
            'company_id' => 1,
            'workshift_id' => 1,
            'image' => null,
            'religion' => 'islam',
        ];
    }
}
