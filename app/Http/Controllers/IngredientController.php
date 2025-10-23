<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::with([
            'category', 'packTypeUnit', 'innerUnit', 'weightUnitInner', 'unit', 'updater'
        ])->paginate(20);
        return view('ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('ingredients.create', compact('categories', 'units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:ingredients,name',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:100',
            'measurement_type' => 'required|in:Unit based,Pack-based',
            'pack_type_unit_id' => 'nullable|exists:units,id',
            'inner_unit_id' => 'nullable|exists:units,id',
            'quantity_per_pack' => 'nullable|integer|min:1',
            'weight_per_inner_unit' => 'nullable|numeric|min:0',
            'weight_unit_inner_id' => 'nullable|exists:units,id',
            'weight_type' => 'required|in:Fixed,Ranged',
            'weight_per_pack' => 'nullable|numeric|min:0',
            'min_weight_per_pack' => 'nullable|numeric|min:0',
            'max_weight_per_pack' => 'nullable|numeric|min:0',
            'unit_id' => 'nullable|exists:units,id',
            'base_unit' => 'required|in:G,ML,PCS',
        ]);
        $data = $request->all();
        $data['updated_by'] = Auth::id();
        Ingredient::create($data);
        return redirect()->route('ingredients.index')->with('success', 'Ingredient added!');
    }

    public function edit(Ingredient $ingredient)
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('ingredients.edit', compact('ingredient', 'categories', 'units'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:ingredients,name,' . $ingredient->id,
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:100',
            'measurement_type' => 'required|in:Unit based,Pack-based',
            'pack_type_unit_id' => 'nullable|exists:units,id',
            'inner_unit_id' => 'nullable|exists:units,id',
            'quantity_per_pack' => 'nullable|integer|min:1',
            'weight_per_inner_unit' => 'nullable|numeric|min:0',
            'weight_unit_inner_id' => 'nullable|exists:units,id',
            'weight_type' => 'required|in:Fixed,Ranged',
            'weight_per_pack' => 'nullable|numeric|min:0',
            'min_weight_per_pack' => 'nullable|numeric|min:0',
            'max_weight_per_pack' => 'nullable|numeric|min:0',
            'unit_id' => 'nullable|exists:units,id',
            'base_unit' => 'required|in:G,ML,PCS',
        ]);
        $data = $request->all();
        $data['updated_by'] = Auth::id();
        $ingredient->update($data);
        return redirect()->route('ingredients.index')->with('success', 'Ingredient updated!');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Ingredient deleted!');
    }
}