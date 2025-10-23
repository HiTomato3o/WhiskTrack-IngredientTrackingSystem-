<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientStock extends Model
{
    protected $table = 'ingredient_stock';
    protected $fillable = [
        'ingredient_id', 'location_id', 'class_id',
        'stock_total_base_unit', 'stock_packs',
        'minimum_level_base_unit', 'is_alert_on',
        'last_updated_at', 'updated_by'
    ];

    protected $casts = [
        'updated_by' => 'integer',
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function location()
    {
        return $this->belongsTo(StockLocation::class, 'location_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id'); // Assuming your class model is ClassModel
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}