<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Stock for {{ $stock->ingredient->name }}</h2>
    </x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('stock.update', $stock) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Stock Total ({{ $stock->ingredient->base_unit }})</label>
                <input type="number" name="stock_total_base_unit" value="{{ old('stock_total_base_unit', $stock->stock_total_base_unit) }}" min="0" class="form-input w-full" required>
                @error('stock_total_base_unit')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            @if($stock->location->name == 'Central Store')
                <div>
                    <label>Minimum Level ({{ $stock->ingredient->base_unit }})</label>
                    <input type="number" name="minimum_level_base_unit" value="{{ old('minimum_level_base_unit', $stock->minimum_level_base_unit) }}" min="0" class="form-input w-full">
                    @error('minimum_level_base_unit')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label>Alert On</label>
                    <input type="checkbox" name="is_alert_on" {{ $stock->is_alert_on ? 'checked' : '' }}>
                </div>
            @endif
            <button type="submit" class="btn btn-success mt-4">Save</button>
        </form>
    </div>
</x-app-layout>