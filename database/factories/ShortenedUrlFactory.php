<?php

namespace Database\Factories;

use App\Models\ShortenedUrl;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Redis;

/**
 * @extends Factory<ShortenedUrl>
 */
class ShortenedUrlFactory extends Factory
{
    public function definition(): array
    {
        $originalUrl = $this->faker->url;
        $hashUrl = hash('crc32', $originalUrl);

        return [
            'original_url' => $originalUrl,
            'shortened_url' => url('/') . '/' . $hashUrl,
        ];
    }
}
