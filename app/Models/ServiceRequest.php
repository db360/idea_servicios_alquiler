<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'company_id', 'description', 'status',
    ];

    // Relación con propiedad
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relación con empresa de servicios
    public function serviceCompany()
    {
        return $this->belongsTo(ServiceCompany::class, 'company_id');
    }
}
