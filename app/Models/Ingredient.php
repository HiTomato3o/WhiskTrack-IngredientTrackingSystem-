<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    protected $fillable = [
        'name', 
        'category_id', 
        'brand', 
        'measurement_type',
        'pack_type_unit_id', 
        'inner_unit_id', 
        'quantity_per_pack',
        'weight_per_inner_unit', 
        'weight_unit_inner_id',
        'weight_type', 
        'weight_per_pack', 
        'min_weight_per_pack', 
        'max_weight_per_pack',
        'unit_id', 
        'base_unit', 
        'updated_by'
    ];

    protected $casts = [
        'updated_by' => 'integer',
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function packTypeUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'pack_type_unit_id');
    }

    public function innerUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'inner_unit_id');
    }

    public function weightUnitInner(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'weight_unit_inner_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}