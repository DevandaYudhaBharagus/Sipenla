<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas =
            [
                'Ganjil',
                'Genap'
            ];

        foreach ($datas as $data) {
            Semester::create([
                'semester_name' => $data,
            ]);
        }
    }
}
