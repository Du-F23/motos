<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'quantity',
        'stock',
        'price',
        'active',
        'product_id',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
