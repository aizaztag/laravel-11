<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public $table = 'messages';
    protected $fillable = ['id', 'user_id', 'text'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id')->withDefault(['name' => 'Guest']);
    }

    public function getTimeAttribute(): string {
        return date(
            "d M Y, H:i:s",
            strtotime($this->attributes['created_at'])
        );
    }

    public function availableCredits()
    {
        return $this->belongsTo(User::class, 'user_id')
                        ->where('available_credits', '>', 9 )->get();
    }


}
