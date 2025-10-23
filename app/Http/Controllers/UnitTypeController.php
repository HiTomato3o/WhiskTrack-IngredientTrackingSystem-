<?php

namespace App\Http\Controllers;

use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    public function index()
    {
        $unitTypes = UnitType::paginate(20);
        return view('settings.unit_types.index', compact('unitTypes'));
    }

    public function create()
    {
        return view('settings.unit_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:50|unique:unit_types,type_name',
        ]);
        UnitType::create($request->only(['type_name']));
        return redirect()->route('settings.unit_types.index')->with('success', 'Unit type added!');
    }

    public function edit(UnitType $unitType)
    {
        return view('settings.unit_types.edit', compact('unitType'));
    }

    public function update(Request $request, UnitType $unitType)
    {
        $request->validate([
            'type_name' => 'required|string|max:50|unique:unit_types,type_name,' . $unitType->id,
        ]);
        $unitType->update($request->only(['type_name']));
        return redirect()->route('settings.unit_types.index')->with('success', 'Unit type updated!');
    }

    public function destroy(UnitType $unitType)
    {
        $unitType->delete();
        return redirect()->route('settings.unit_types.index')->with('success', 'Unit type deleted!');
    }
}