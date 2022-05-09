<?php

namespace Database\Seeders;

use App\Models\TypeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_bloods')->delete();

        $types = ['O-','O+','A+','A-','B+','B-','AB+','AB-'];

        foreach($types as $type){
            TypeBlood::create(['name' => $type]);
        }
    }
}
