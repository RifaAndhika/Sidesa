<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => 1,
            'name' => 'Admin SiDesa',
            'email' => 'admin@sidesa.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '1' // => 'Admin'
        ]);
        User::create([
            'name' => 'Penduduk 1',
            'email' => 'penduduk@sidesa.com',
            'password' => 'password',
            'status' => 'approved',
            'role_id' => '2' // => 'User'
        ]);

        Resident::create([
            'user_id' => 2,
            'nik'=> '1234567890123456',
            'name' => 'Usman',
            'gender' => 'male',
            'birth_date' => '2000-01-01',
            'birth_place' => 'Jakarta',
            'address' => 'Jl. Raya No. 1',
            'marital_status' => 'single',

        ]);
    }
}
