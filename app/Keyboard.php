<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Keyboard extends Model
{
    protected $table = 'keyboards';

    protected $fillable = [
        'name',
        'brand',
        'switch_type',
        'layout',
        'connection',
        'hot_swappable',
        'price',
        'stock',
        'release_date',
        'description',
        'image_url',
        'buy_link',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
        'hot_swappable' => 'boolean',
        'release_date' => 'date',
    ];

    /**
     * Get the resolved image path (local storage URL or external URL).
     *
     * @return string|null
     */
    public function getImagePathAttribute()
    {
        if (empty($this->image_url)) {
            return null;
        }

        if (Str::startsWith($this->image_url, ['http://', 'https://'])) {
            return $this->image_url;
        }

        return Storage::url($this->image_url);
    }
}
