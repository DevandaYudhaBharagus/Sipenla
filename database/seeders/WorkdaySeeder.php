<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workday;
use Faker\Factory as Faker;

class WorkdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $datas = [
            [
                'company_id' => 1,
                'workshift_id' =>1
            ]
        ];

        foreach ($datas as $data) {
            for($i = 2; $i <= 6; $i++){
                Workday::create([
                    'company_id' => $data['company_id'],
                    'workshift_id' => $data['workshift_id'],
                    'days_id' => $i
                ]);
            }
        }
    }
}
