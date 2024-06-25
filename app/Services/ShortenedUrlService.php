<?php

namespace App\Services;


use App\Jobs\SaveShortenedUrlJob;
use App\Models\ShortenedUrl;

class ShortenedUrlService
{
    public function generateOrRetrieveShortUrl(string $url): string
    {
        $hashedUrl = hash('crc32', $url);

        $shortenedUrl = ShortenedUrl::firstOrCreate([
            'original_url' => $url,
            'shortened_url' => url('/') . '/api/' . $hashedUrl,
        ]);

        if($shortenedUrl->wasRecentlyCreated)
            SaveShortenedUrlJob::dispatch($hashedUrl, $url);

        return $shortenedUrl->shortened_url;
    }

}
