<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(4)->create();
        $this->call(BloodSeeder::class);
        $this->call(NationalitySeed::class);
        $this->call(ReligionSeed::class);
        $this->call(Specialize::class);
    }
}
