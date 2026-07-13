<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = ['name'];

    public function konsers()
    {
        return $this->hasMany(Konser::class, 'kategori_id');
    }
}