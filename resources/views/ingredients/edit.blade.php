<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Ingredient</h2>
    </x-slot>
    <div class="max-w-lg mx-auto mt-6">
        <form method="POST" action="{{ route('ingredients.update', $ingredient) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Name</label>
                <input type="text" name="name" maxlength="50" class="form-input w-full" value="{{ old('name', $ingredient->name) }}" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Category</label>
                <select name="category_id" class="form-input w-full" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $ingredient->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Brand</label>
                <input type="text" name="brand" maxlength="100" class="form-input w-full" value="{{ old('brand', $ingredient->brand) }}">
                @error('brand')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Measurement Type</label>
                <select name="measurement_type" class="form-input w-full" required>
                    <option value="Unit based" {{ $ingredient->measurement_type == 'Unit based' ? 'selected' : '' }}>Unit based</option>
                    <option value="Pack-based" {{ $ingredient->measurement_type == 'Pack-based' ? 'selected' : '' }}>Pack-based</option>
                </select>
                @error('measurement_type')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Pack Type Unit</label>
                <select name="pack_type_unit_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ $ingredient->pack_type_unit_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>
                @error('pack_type_unit_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Inner Unit</label>
                <select name="inner_unit_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ $ingredient->inner_unit_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>
                @error('inner_unit_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Quantity per Pack</label>
                <input type="number" name="quantity_per_pack" min="1" class="form-input w-full" value="{{ old('quantity_per_pack', $ingredient->quantity_per_pack) }}">
                @error('quantity_per_pack')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Weight per Inner Unit</label>
                <input type="number" step="any" name="weight_per_inner_unit" class="form-input w-full" value="{{ old('weight_per_inner_unit', $ingredient->weight_per_inner_unit) }}">
                @error('weight_per_inner_unit')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Weight Unit Inner</label>
                <select name="weight_unit_inner_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ $ingredient->weight_unit_inner_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>
                @error('weight_unit_inner_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Weight Type</label>
                <select name="weight_type" class="form-input w-full" required>
                    <option value="Fixed" {{ $ingredient->weight_type == 'Fixed' ? 'selected' : '' }}>Fixed</option>
                    <option value="Ranged" {{ $ingredient->weight_type == 'Ranged' ? 'selected' : '' }}>Ranged</option>
                </select>
                @error('weight_type')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Weight per Pack</label>
                <input type="number" step="any" name="weight_per_pack" class="form-input w-full" value="{{ old('weight_per_pack', $ingredient->weight_per_pack) }}">
                @error('weight_per_pack')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Min Weight per Pack</label>
                <input type="number" step="any" name="min_weight_per_pack" class="form-input w-full" value="{{ old('min_weight_per_pack', $ingredient->min_weight_per_pack) }}">
                @error('min_weight_per_pack')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Max Weight per Pack</label>
                <input type="number" step="any" name="max_weight_per_pack" class="form-input w-full" value="{{ old('max_weight_per_pack', $ingredient->max_weight_per_pack) }}">
                @error('max_weight_per_pack')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Unit (for Unit-based)</label>
                <select name="unit_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ $ingredient->unit_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->unit_name }}
                        </option>
                    @endforeach
                </select>
                @error('unit_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Base Unit</label>
                <select name="base_unit" class="form-input w-full" required>
                    <option value="G" {{ $ingredient->base_unit == 'G' ? 'selected' : '' }}>G</option>
                    <option value="ML" {{ $ingredient->base_unit == 'ML' ? 'selected' : '' }}>ML</option>
                    <option value="PCS" {{ $ingredient->base_unit == 'PCS' ? 'selected' : '' }}>PCS</option>
                </select>
                @error('base_unit')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success mt-4">Save</button>
        </form>
    </div>
</x-app-layout>