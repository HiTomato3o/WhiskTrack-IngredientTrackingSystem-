<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockLocation extends Model
{
    protected $table = 'stock_locations';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function ingredientStocks()
    {
        return $this->hasMany(IngredientStock::class, 'location_id');
    }
}