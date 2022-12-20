<?php

namespace Database\Seeders;

use App\Models\StatusSaving;
use Illuminate\Database\Seeder;

class StatusSavingSeeder extends Seeder
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
                'Belum Bisa Tarik'
            ];

        foreach ($datas as $data) {
            StatusSaving::create([
                'status_saving' => $data,
            ]);
        }
    }
}
