<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'price'
    ];

//    public function motos(): BelongsTo
//    {
//        return $this->belongsTo(Motos::class, 'motos_id');
//    }
    public function moto()
    {
        return $this->belongsToMany(Motos::class, 'product_moto', 'product_id', 'moto_id')
            ->withPivot('id');
    }

    public function motos()
    {
        return $this->belongsToMany(Motos::class, 'product_moto', 'product_id', 'moto_id');
    }

    public function parts()
    {
        return $this->hasMany(Parts::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Services::class, 'producto_servicio', 'product_id', 'servicio_id');
    }
}
