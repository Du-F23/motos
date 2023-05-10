<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motos extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'marca',
        'year',
        'model',
        'color',
        'hp',
        'image',
        'category_id',
    ];
}
