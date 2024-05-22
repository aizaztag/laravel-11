<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['note', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();

        self::creating( static function ($model) {
            $model->user_id = 1;
        });
    }

    public static function withMoreReads(int $reads)
    {
           return static::where('reads' , $reads)->get();
    }



}
