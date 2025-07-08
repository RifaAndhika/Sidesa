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
    }
}
