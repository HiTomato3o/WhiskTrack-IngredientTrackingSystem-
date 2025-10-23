<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    protected $table = 'unit_types';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function units() { return $this->hasMany(Unit::class); }
}