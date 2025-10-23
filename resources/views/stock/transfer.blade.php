<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Transfer Stock for {{ $stock->ingredient->name }}</h2>
    </x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('stock.transfer', $stock) }}">
            @csrf
            <div>
                <label>Quantity to Transfer ({{ $stock->ingredient->base_unit }})</label>
                <input type="number" name="quantity" min="1" max="{{ $stock->stock_total_base_unit }}" class="form-input w-full" required>
                @error('quantity')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Destination Location</label>
                <select name="to_location_id" class="form-input w-full" required>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Destination Class (if applicable)</label>
                <select name="to_class_id" class="form-input w-full">
                    <option value="">-</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-4">Transfer</button>
        </form>
    </div>
</x-app-layout>