<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konser extends Model
{
    protected $fillable = ['kategori_id', 'name', 'date', 'location', 'description', 'image'];

    protected $appends = ['image_url'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'konser_id');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        $baseUrl = rtrim(config('global.api_url', 'http://localhost:8001/api'), '/api');

        return $baseUrl . '/storage/' . $this->image;
    }
}