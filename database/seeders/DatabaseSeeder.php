<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Other seeders can go here
        $this->call(AdminSeeder::class);
    }
}
