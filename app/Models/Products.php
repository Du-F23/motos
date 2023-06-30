<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'marca',
        'piece',
        'image',
        'active',
        'moto_id'
    ];

    public function motos(): BelongsTo
    {
        return $this->belongsTo(Motos::class, 'moto_id');
    }

    public function parts()
    {
        return $this->hasMany(Parts::class);
    }
}
