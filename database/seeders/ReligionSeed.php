<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ReligionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->delete();

        $rel = [
            'مسلم',
            'مسيحى',
            'غير ذالك',
        ];

        foreach($rel as $r){
            Religion::create(['name' => $r]);
        }

    }
}
