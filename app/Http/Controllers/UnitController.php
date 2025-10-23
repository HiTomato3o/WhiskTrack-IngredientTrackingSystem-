<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::paginate(20);
        return view('settings.units.index', compact('units'));
    }

    public function create()
    {
        return view('settings.units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_name' => 'required|string|max:50|unique:units,unit_name',
            'abbreviation' => 'nullable|string|max:10',
        ]);
        Unit::create($request->only(['unit_name', 'abbreviation']));
        return redirect()->route('settings.units.index')->with('success', 'Unit added!');
    }

    public function edit(Unit $unit)
    {
        return view('settings.units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'unit_name' => 'required|string|max:50|unique:units,unit_name,' . $unit->id,
            'abbreviation' => 'nullable|string|max:10',
        ]);
        $unit->update($request->only(['unit_name', 'abbreviation']));
        return redirect()->route('settings.units.index')->with('success', 'Unit updated!');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('settings.units.index')->with('success', 'Unit deleted!');
    }
}