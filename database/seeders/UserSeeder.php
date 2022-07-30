<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminId = 1;
        $status = 1;
        $blood_group ='AB+'; 
        DB::table('users')->insert([
            'name' => Str::random(6),
            'email' => 'superadmin@bdms.com',
            'password' => Hash::make('superadmin@bdms'),
            'blood_group'=> $blood_group,
            'nid_number' => '11111111',
            'total_donated'=> '1',
            'last_donated'=>Carbon::now(),
            'email_verified_at' => Carbon::now(),
            'role_id'=>$superAdminId,
            'approval_status' => $status,
            'approved_by' => $status,

        ]);
    }
}
