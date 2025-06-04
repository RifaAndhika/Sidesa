<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Resident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::create([
            'resident_id' => 1,
            'title' => 'Pengaduan 1',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, autem.',
        ]);
    }
}
