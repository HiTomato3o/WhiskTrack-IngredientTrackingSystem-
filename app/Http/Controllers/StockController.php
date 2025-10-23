<?php

namespace App\Http\Controllers;

use App\Models\IngredientStock;
use App\Models\StockLocation;
use App\Models\Ingredient;
use App\Models\User;
use App\Models\Category;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $totalIngredients = Ingredient::count();
        $centralLocation = StockLocation::where('name', 'Central Store')->first();

        if (!$centralLocation) {
            return redirect()->back()->withErrors(['Central Store location not found.']);
        }

        $criticalStocks = IngredientStock::where('location_id', $centralLocation->id)
            ->whereColumn('stock_total_base_unit', '<=', DB::raw('minimum_level_base_unit * 0.5'))
            ->with('ingredient')
            ->get();

        $lowStocks = IngredientStock::where('location_id', $centralLocation->id)
            ->whereColumn('stock_total_base_unit', '<=', 'minimum_level_base_unit')
            ->whereColumn('stock_total_base_unit', '>', DB::raw('minimum_level_base_unit * 0.5'))
            ->with('ingredient')
            ->get();

        $alertStocks = IngredientStock::where('location_id', $centralLocation->id)
            ->whereColumn('stock_total_base_unit', '<=', 'minimum_level_base_unit')
            ->with('ingredient')
            ->get();

        return view('stock.index', compact('totalIngredients', 'criticalStocks', 'lowStocks', 'alertStocks'));
    }

    public function centralStore(Request $request)
    {
        $centralLocation = StockLocation::where('name', 'Central Store')->first();

        if (!$centralLocation) {
            return redirect()->back()->withErrors(['Central Store location not found.']);
        }

        $query = IngredientStock::where('location_id', $centralLocation->id)->with(['ingredient', 'updater']);

        if ($request->has('status')) {
            if ($request->status == 'critical') {
                $query->whereColumn('stock_total_base_unit', '<=', DB::raw('minimum_level_base_unit * 0.5'));
            } elseif ($request->status == 'low') {
                $query->whereColumn('stock_total_base_unit', '<=', 'minimum_level_base_unit')
                    ->whereColumn('stock_total_base_unit', '>', DB::raw('minimum_level_base_unit * 0.5'));
            } elseif ($request->status == 'normal') {
                $query->whereColumn('stock_total_base_unit', '>', 'minimum_level_base_unit');
            }
        }
        if ($request->has('category_id')) {
            $query->whereHas('ingredient', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        $stocks = $query->get();

        $categories = Category::all();

        return view('stock.central', compact('stocks', 'categories'));
    }

    public function classStorage()
    {
        $classLocation = StockLocation::where('name', 'Class Storage')->first();

        if (!$classLocation) {
            return redirect()->back()->withErrors(['Class Storage location not found.']);
        }

        $classStocks = IngredientStock::where('location_id', $classLocation->id)
            ->with(['ingredient', 'updater', 'class'])
            ->get()
            ->groupBy('class_id');
        return view('stock.class', compact('classStocks'));
    }

    public function classStorageView($classId)
    {
        $classLocation = StockLocation::where('name', 'Class Storage')->first();

        if (!$classLocation) {
            return redirect()->back()->withErrors(['Class Storage location not found.']);
        }

        $stocks = IngredientStock::where('location_id', $classLocation->id)
            ->where('class_id', $classId)
            ->with(['ingredient', 'updater', 'class'])
            ->get();
        return view('stock.class_view', compact('stocks', 'classId'));
    }

    public function edit(IngredientStock $stock)
    {
        return view('stock.edit', compact('stock'));
    }

    public function update(Request $request, IngredientStock $stock)
    {
        $request->validate([
            'stock_total_base_unit' => 'required|integer|min:0',
            'minimum_level_base_unit' => 'nullable|integer|min:0',
            'is_alert_on' => 'boolean',
        ]);
        $stock->update([
            'stock_total_base_unit' => $request->stock_total_base_unit,
            'minimum_level_base_unit' => $request->minimum_level_base_unit ?? $stock->minimum_level_base_unit,
            'is_alert_on' => $request->has('is_alert_on'),
            'last_updated_at' => now(),
            'updated_by' => Auth::id(),
        ]);
        return redirect()->back()->with('success', 'Stock updated successfully!');
    }

    public function transferForm(IngredientStock $stock)
    {
        $locations = StockLocation::all();
        $classes = ClassModel::all();
        return view('stock.transfer', compact('stock', 'locations', 'classes'));
    }

    public function transfer(Request $request, IngredientStock $stock)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'to_location_id' => 'required|exists:stock_locations,id',
            'to_class_id' => 'nullable|exists:classes,id',
        ]);
        $quantity = $request->quantity;
        $to_location_id = $request->to_location_id;
        $to_class_id = $request->to_class_id;

        DB::transaction(function () use ($stock, $quantity, $to_location_id, $to_class_id) {
            // Decrease from source
            $stock->decrement('stock_total_base_unit', $quantity);
            $stock->last_updated_at = now();
            $stock->updated_by = Auth::id();
            $stock->save();

            // Add to destination
            $destStock = IngredientStock::firstOrCreate(
                [
                    'ingredient_id' => $stock->ingredient_id,
                    'location_id' => $to_location_id,
                    'class_id' => $to_class_id,
                ],
                [
                    'stock_total_base_unit' => 0,
                    'stock_packs' => 0,
                    'minimum_level_base_unit' => 0,
                    'is_alert_on' => true,
                    'last_updated_at' => now(),
                    'updated_by' => Auth::id(),
                ]
            );
            $destStock->increment('stock_total_base_unit', $quantity);
            $destStock->last_updated_at = now();
            $destStock->updated_by = Auth::id();
            $destStock->save();
        });

        return redirect()->back()->with('success', 'Stock transferred successfully!');
    }
}