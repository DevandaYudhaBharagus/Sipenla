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
            'ace',
            'aae',
            'fcl',
            'ftl',
            'eas',
            'ees',
            'ess',
            'els',
            'ppf',
            'opf',
            'prf',
            'prd',
            'mas',
            'mes',
            'mss',
            'mls',
        ];

        $shorts = [
            'Check In',
            'Absence',
            'Facility',
            'Facility',
            'Extra',
            'Extra',
            'Extra',
            'Extra',
            'Loan',
            'Loan',
            'Loan',
            'Loan',
            'mapel',
            'mapel',
            'mapel',
            'mapel',
        ];

        $longs = [
            'Attendance Check In Employee',
            'Attendance Absence Employee',
            'Facility Layak',
            'Facility Tidak Layak',
            'Extra Hadir Siswa',
            'Extra Alpha Siswa',
            'Extra Sakit Siswa',
            'Extra Izin Siswa',
            'Pending Peminjaman Fasilitas',
            'ongoing Peminjaman Fasilitas',
            'Pending Pengembalian Fasilitas',
            'Peminjaman Fasilitas Dikembalikan',
            'Mapel Hadir Siswa',
            'Mapel Alpha Siswa',
            'Mapel Sakit Siswa',
            'Mapel Izin Siswa',
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
