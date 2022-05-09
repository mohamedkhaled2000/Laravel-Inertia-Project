<?php

namespace Database\Seeders;

use App\Models\Nationality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class NationalitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->delete();
        $nation = [
            'مصرى',
            'سعودى',
            'افغانى',
            'البانى',
            'امريكى',
            'كندى',
            'اندونيسى',
            'عراقى',
            'اماراتى',
            'عمانى',
            'جزائرى',
            'مغربى',
            'كويتى',
            'قطرى',
        ];
        foreach($nation as $n){
            Nationality::create(['name' => $n]);
        }

    }
}
