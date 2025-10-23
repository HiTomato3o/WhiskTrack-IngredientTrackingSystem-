<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    protected $fillable = [
        'unit_name', 
        'base_unit', 
        'conversion_factor', 
        'unit_type_id'];
    public $timestamps = false;

    public function unitType() { return $this->belongsTo(UnitType::class); }
}
