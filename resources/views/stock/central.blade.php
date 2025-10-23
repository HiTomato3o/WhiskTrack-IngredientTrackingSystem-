<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Central Store Stock</h2>
    </x-slot>
    <div class="py-4 max-w-7xl mx-auto">
        {{-- Add filtering form here --}}
        <form method="GET" action="{{ route('stock.central.filter') }}" class="mb-4 flex gap-4">
            <div>
                <label>Status:</label>
                <select name="status" class="form-input">
                    <option value="">All</option>
                    <option value="critical">Critical</option>
                    <option value="low">Low</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
            <div>
                <label>Category:</label>
                <select name="category_id" class="form-input">
                    <option value="">All</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-blue">Filter</button>
        </form>

        <table class="table w-full">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Ingredient</th>
                    <th>Brand</th>
                    <th>Pack Info</th>
                    <th>Stocks(Packs)</th>
                    <th>Stock(Total)</th>
                    <th>Min Level</th>
                    <th>Alert</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>
                            <span class="w-3 h-3 rounded-full inline-block"
                                style="background: {{ $stock->stock_total_base_unit <= ($stock->minimum_level_base_unit * 0.5) ? '#F87171' : ($stock->stock_total_base_unit <= $stock->minimum_level_base_unit ? '#FBBF24' : '#34D399') }}"></span>
                        </td>
                        <td>{{ $stock->ingredient->name }}</td>
                        <td>{{ $stock->ingredient->brand ?? '-' }}</td>
                        <td>
                            @if($stock->ingredient->packTypeUnit)
                                {{ $stock->ingredient->packTypeUnit->unit_name }}
                                @if($stock->ingredient->quantity_per_pack && $stock->ingredient->innerUnit)
                                    ({{ $stock->ingredient->quantity_per_pack }} {{ $stock->ingredient->innerUnit->unit_name }} x {{ $stock->ingredient->weight_per_inner_unit }} {{ $stock->ingredient->weightUnitInner->unit_name ?? '-' }})
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            {{ $stock->stock_packs }} {{ $stock->ingredient->packTypeUnit->unit_name ?? '-' }}
                        </td>
                        <td>{{ $stock->stock_total_base_unit }} {{ $stock->ingredient->base_unit }}</td>
                        <td>{{ $stock->minimum_level_base_unit }} {{ $stock->ingredient->base_unit }}</td>
                        <td>
                            @if($stock->is_alert_on)
                                <span class="text-green-600 font-bold">ON</span>
                            @else
                                <span class="text-red-600 font-bold">OFF</span>
                            @endif
                        </td>
                        <td>
                            @if($stock->updater)
                                {{ $stock->last_updated_at ? \Carbon\Carbon::parse($stock->last_updated_at)->format('d/m/Y H:i') : '-' }} by {{ \Illuminate\Support\Str::before(\Illuminate\Support\Str::replace([' bin ', ' binti '], '', $stock->updater->name), ' ', 2) }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('stock.edit', $stock) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('stock.transfer.form', $stock) }}" class="btn btn-warning">Transfer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>