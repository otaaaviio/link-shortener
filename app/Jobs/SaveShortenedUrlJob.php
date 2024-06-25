<?php

namespace App\Jobs;

use App\Models\ShortenedUrl;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class SaveShortenedUrlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected readonly string $hash,
        protected readonly string $originalUrl
    ) {
        //
    }

    public function handle(): void
    {
        Redis::set($this->hash, $this->originalUrl);
    }
}
