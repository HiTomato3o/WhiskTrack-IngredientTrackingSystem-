<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Ingredient</h2>
    </x-slot>
    <div class="max-w-lg mx-auto mt-6">
        <form method="POST" action="{{ route('ingredients.store') }}">
            @csrf
            <div>
                <label>Name</label>
                <input type="text" name="name" maxlength="50" class="form-input w-full" required>
            </div>
            <div>
                <label>Category</label>
                <select name="category_id" class="form-input w-full" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Brand</label>
                <input type="text" name="brand" maxlength="100" class="form-input w-full">
            </div>
            <div>
                <label>Measurement Type</label>
                <select name="measurement_type" class="form-input w-full" required>
                    <option value="Unit based">Unit based</option>
                    <option value="Pack-based">Pack-based</option>
                </select>
            </div>
            <div>
                <label>Pack Type Unit</label>
                <select name="pack_type_unit_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Inner Unit</label>
                <select name="inner_unit_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Quantity per Pack</label>
                <input type="number" name="quantity_per_pack" min="1" class="form-input w-full">
            </div>
            <div>
                <label>Weight per Inner Unit</label>
                <input type="number" step="any" name="weight_per_inner_unit" class="form-input w-full">
            </div>
            <div>
                <label>Weight Unit Inner</label>
                <select name="weight_unit_inner_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Weight Type</label>
                <select name="weight_type" class="form-input w-full" required>
                    <option value="Fixed">Fixed</option>
                    <option value="Ranged">Ranged</option>
                </select>
            </div>
            <div>
                <label>Weight per Pack</label>
                <input type="number" step="any" name="weight_per_pack" class="form-input w-full">
            </div>
            <div>
                <label>Min Weight per Pack</label>
                <input type="number" step="any" name="min_weight_per_pack" class="form-input w-full">
            </div>
            <div>
                <label>Max Weight per Pack</label>
                <input type="number" step="any" name="max_weight_per_pack" class="form-input w-full">
            </div>
            <div>
                <label>Unit (for Unit-based)</label>
                <select name="unit_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Base Unit</label>
                <select name="base_unit" class="form-input w-full" required>
                    <option value="G">G</option>
                    <option value="ML">ML</option>
                    <option value="PCS">PCS</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-4">Save</button>
        </form>
    </div>
</x-app-layout>