<?php

namespace Database\Seeders;

use App\Models\Speicalize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Specialize extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('speicalizes')->delete();
        $spe = [
            "عربى",
            "انجليزى",
            "علوم",
            "حاسب الى",
            "رياضيات",
            "تاريخ",
            "جغرافيا",
        ];

        foreach($spe as $r){
            Speicalize::create(['name' => $r]);
        }

    }
}
