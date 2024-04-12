<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsedFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'credits',
        'feature_id',
        'user_id',
        'package_id',

    ];

    public function casts(): array
    {
        return [
          'data' => 'array'
        ];
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
