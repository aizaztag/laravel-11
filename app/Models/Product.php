<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ProductStatusEnum;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'body', 'status'
    ];


    protected $casts = [
        'status' => ProductStatusEnum::class
    ];
}
