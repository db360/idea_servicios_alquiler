<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'company_name', 'description', 'address', 'phone', 'website', 'service_type',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function serviceRequests() {
        return $this->hasMany(ServiceRequest::class, 'company_id');
    }
}
