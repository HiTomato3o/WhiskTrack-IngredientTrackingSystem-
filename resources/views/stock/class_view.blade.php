<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Class Storage - Class {{ $classId }}</h2>
    </x-slot>
    <div class="py-4 max-w-7xl mx-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th>Brand</th>
                    <th>Pack Info</th>
                    <th>Stocks(Packs)</th>
                    <th>Stock(Total)</th>
                    <th>Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
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
                        <td>{{ $stock->stock_packs }} {{ $stock->ingredient->packTypeUnit->unit_name ?? '-' }}</td>
                        <td>{{ $stock->stock_total_base_unit }} {{ $stock->ingredient->base_unit }}</td>
                        <td>
                            @if($stock->updater)
                                {{ $stock->last_updated_at ? \Carbon\Carbon::parse($stock->last_updated_at)->format('d/m/Y H:i') : '-' }} by {{ \Illuminate\Support\Str::before(\Illuminate\Support\Str::replace([' bin ', ' binti '], '', $stock->updater->name), ' ', 2) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>