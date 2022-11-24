<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaveTypes = ['Cuti Melahirkan', 'Cuti Berobat', 'Cuti Kematian Ahli Keluarga', 'Cuti Haji/Umroh', 'Cuti Lain - Lain'];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create([
                'leave_type_name' => $leaveType,
            ]);
        }
    }
}
