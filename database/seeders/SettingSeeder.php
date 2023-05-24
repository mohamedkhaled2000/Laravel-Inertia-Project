<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        $data = [
            ['key' => 'current_session',    'value' => '2022-2023'],
            ['key' => 'school_title',       'value' => 'IS'],
            ['key' => 'school_name',        'value' => 'International School'],
            ['key' => 'end_first_tearm',    'value' => '01-2-2022'],
            ['key' => 'end_second_tearm',   'value' => '01-7-2022'],
            ['key' => 'phone',   'value' => '01060638017'],
            ['key' => 'address',   'value' => 'mansoura'],
            ['key' => 'email',   'value' => 'IS@email.com'],
            ['key' => 'logo',   'value' => '1.jpg'],
        ];

        DB::table('settings')->insert($data);

    }
}
