<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        Member::create([
            'name' => 'Siti Aminah',
            'member_code' => 'MBR-2025-003',
            'email' => 'siti@email.com',
            'phone' => '08567891234',
            'address' => 'Jl. Pahlawan No. 5, Surabaya',
            'status' => 'active',
            'joined_at' => '2025-03-30'
        ]);
    }
}
