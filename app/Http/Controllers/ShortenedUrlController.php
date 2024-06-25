<?php

namespace App\Http\Controllers;

use App\Exceptions\ShortenedUrlException;
use App\Http\Requests\ShortenedUrlRequest;
use App\Services\ShortenedUrlService;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response as StatusCode;

class ShortenedUrlController extends Controller
{
    protected readonly ShortenedUrlService $service;

    public function __construct(
        ShortenedUrlService $service
    ) {
        $this->service = $service;
    }

    public function findOrCreate(ShortenedUrlRequest $request): JsonResponse
    {
        $req = $request->validated();

        $shortenedUrl = $this->service->generateOrRetrieveShortUrl($req['original_url']);

        return response()->json([
            'shortened_url' => $shortenedUrl
        ], StatusCode::HTTP_OK);
    }

    /**
     * @throws ShortenedUrlException
     */
    public function redirectToOriginalUrl(string $hashedUrl): Application|Redirector|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        $shortenedUrl = Redis::get($hashedUrl);

        if (!$shortenedUrl)
            throw ShortenedUrlException::urlNotFound();

        $shortenedUrl = trim($shortenedUrl, '"');

        return redirect()->away($shortenedUrl);
    }
}
