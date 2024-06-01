<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'address', 'city', 'state', 'postal_code'];

    // Relación con usuario
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Relación con solicitudes de servicio
    public function serviceRequests(){
        return $this->hasMany(ServiceRequest::class, 'service_requests');
    }

    public function reviews(){
        return $this->morphMany(Review::class, 'reviewed');
    }
}
