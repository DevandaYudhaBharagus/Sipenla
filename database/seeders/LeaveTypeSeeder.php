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
        $leaveTypes = ['Annual Leave', 'Big Leave', 'Maternity Leave', 'Sick Leave', 'Important Leave', 'Unpaid Leave'];

        foreach ($leaveTypes as $leaveType) {
            LeaveType::create([
                'leave_type_name' => $leaveType,
            ]);
        }
    }
}
