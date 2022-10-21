<?php

namespace Database\Seeders;

use App\Models\StatusCode;
use Illuminate\Database\Seeder;

class StatusCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $codes = [
            'ac',
            'aab'
        ];

        $shorts = [
            'Check In',
            'Absence'
        ];

        $longs = [
            'Attendance Check In',
            'Attendance Absence'
        ];

        for ($i = 0; $i < count($codes); $i++) {
            StatusCode::create([
                'code' => $codes[$i],
                'short' => $shorts[$i],
                'long' => $longs[$i]
            ]);
        }
    }
}
