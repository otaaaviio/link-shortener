<?php

use App\Exceptions\ShortenedUrlException;
use App\Jobs\SaveShortenedUrlJob;
use App\Models\ShortenedUrl;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\HttpFoundation\Response as StatusCode;

uses(DatabaseTransactions::class);

it('should create new hashedUrl and redirect to original url', function () {
    Queue::fake();

    $this->postJson('/api/findOrCreate', [
        'original_url' => 'https://www.google.com',
    ])->assertStatus(StatusCode::HTTP_OK)
        ->assertJsonStructure(['shortened_url']);

    Queue::assertPushed(SaveShortenedUrlJob::class);
});

it('should find a hashedUrl', function () {
    $shortenedUrl = ShortenedUrl::factory()->create();

    $res = $this->postJson('/api/findOrCreate', [
        'original_url' => $shortenedUrl->original_url,
    ]);

    $res->assertStatus(StatusCode::HTTP_OK);
});

it('should redirect to original url', function () {
    $hashUrl = hash('crc32', 'https://www.google.com');

    $shortenedUrl = ShortenedUrl::factory()->create([
        'shortened_url' => url('/') . 'api/' . $hashUrl,
        'original_url' => 'https://www.google.com',
    ]);

    \Illuminate\Support\Facades\Redis::set($hashUrl, $shortenedUrl->original_url);

    $res = $this->getJson('/api/' . $hashUrl);

    $res->assertRedirect($shortenedUrl->original_url);
});

it('cannot redirect with nonexistent shortened url', function () {
    $this->getJson('/api/' . 'nonexistenturl')
        ->assertStatus(StatusCode::HTTP_NOT_FOUND)
        ->assertJson(['message' => 'Url not found']);
});
