<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => function() {
                $email = [null, 'student@gmail.com', 'employee@gmail.com'];
                $i = User::max('id');

                return $email[$i + 1];
            },
            'password' => bcrypt('password'),
            'role' => function() {
                $role = [null, 'student', 'teacher'];
                $i = User::max('id');

                return $role[$i + 1];
            }
        ];
    }
}
