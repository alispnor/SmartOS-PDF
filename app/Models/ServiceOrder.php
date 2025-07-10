<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    protected $fillable = [
        'os_number', 'aircraft_registration', 'start_date', 'end_date', 'document_ref', 'document_date'
    ];

    public function aircraftParts()
    {
        return $this->hasMany(AircraftPart::class);
    }

    public function serviceItems()
    {
        return $this->hasMany(ServiceOrderItem::class);
    }
}



