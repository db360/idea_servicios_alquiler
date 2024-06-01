<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'reviewed_id', 'reviewed_type', 'rating', 'comment',
    ];

    // Relación con usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación polimórfica
    public function reviewed()
    {
        return $this->morphTo();
    }
}
