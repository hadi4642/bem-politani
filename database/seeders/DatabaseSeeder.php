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
        \App\Models\Divisi::factory(6)->create();
        \App\Models\Prodi::factory(9)->create();
        \App\Models\Anggota::factory(10)->create();

    }
}
