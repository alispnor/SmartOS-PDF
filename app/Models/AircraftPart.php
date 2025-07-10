<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class AircraftPart extends Model
{
    // Define os campos que representam uma parte da aeronave
    protected $fillable = [
        'service_order_id', 'type', // 'AIRFRAME', 'LEFT_ENGINE', 'RIGHT_ENGINE', 'LEFT_PROPELLER', 'RIGHT_PROPELLER'
        'model', 'manufacturer', 'sn', 'csn', 'tso', 'tsn', 'revision_manual', 'revision_pn', 'manufacture_year', 'cso',
    ];

    public function serviceOrder()
    {
        return $this->belongsTo(ServiceOrder::class);
    }
}
