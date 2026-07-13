<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['konser_id', 'ticket_name', 'price', 'stock', 'status'];

    public function konser()
    {
        return $this->belongsTo(Konser::class, 'konser_id');
    }
}