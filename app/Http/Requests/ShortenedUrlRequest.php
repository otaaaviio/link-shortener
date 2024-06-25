<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortenedUrlRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'original_url' => 'required|url',
        ];
    }
}
