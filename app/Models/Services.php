<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user',
        'date_service',
        'total',
        'costo_servicio',
        'moto_id',
        'user_id',
    ];



    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'producto_servicio', 'servicio_id', 'product_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function motos(): BelongsTo
    {
        return $this->belongsTo(Motos::class, 'moto_id');
    }
}
