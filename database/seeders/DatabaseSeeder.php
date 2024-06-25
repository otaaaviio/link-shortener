<?php

namespace Database\Seeders;

use App\Models\ShortenedUrl;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if(!app()->isProduction()) {
            ShortenedUrl::factory(10)->create();
        }
    }
}
