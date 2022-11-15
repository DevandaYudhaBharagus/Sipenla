<?php

namespace Database\Seeders;

use App\Models\Assessment;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
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
                'Tugas 1',
                'Tugas 2',
                'UH 1',
                'UH 2',
                'UTS',
                'UAS',
            ];

        foreach ($datas as $data) {
            Assessment::create([
                'assessment_name' => $data,
            ]);
        }
    }
}
