<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $original_url
 * @property string $shortened_url
 * @method static where(string $column, mixed $value)
 * @method static create(array $data)
 * @method static firstOrCreate(mixed $data)
 */
class ShortenedUrl extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_url',
        'shortened_url',
    ];
}
