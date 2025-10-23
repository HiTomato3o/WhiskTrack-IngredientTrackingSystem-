<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Stock Overview</h2>
    </x-slot>
    <div class="py-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <div>Total Ingredients</div>
                <div class="text-2xl font-bold">{{ $totalIngredients }}</div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div>Critical Stock Items</div>
                <div class="text-2xl font-bold text-red-600">{{ $criticalStocks->count() }}</div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <div>Low Stock Items</div>
                <div class="text-2xl font-bold text-yellow-600">{{ $lowStocks->count() }}</div>
            </div>
        </div>
        <div class="bg-white p-6 rounded shadow mb-6">
            <h3 class="font-semibold mb-2">Stock Alerts</h3>
            <div>
                @foreach($alertStocks as $stock)
                    <div class="flex items-center mb-2">
                        <span class="w-3 h-3 rounded-full mr-2"
                            style="background: {{ $stock->stock_total_base_unit <= ($stock->minimum_level_base_unit * 0.5) ? '#F87171' : '#FBBF24' }}"></span>
                        {{ $stock->ingredient->name }} - {{ $stock->stock_total_base_unit <= ($stock->minimum_level_base_unit * 0.5) ? 'Critical' : 'Low' }}
                        ({{ $stock->stock_total_base_unit }} {{ $stock->ingredient->base_unit }})
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex gap-4">
            <div class="w-1/2">
                <a href="{{ route('stock.central') }}" class="btn btn-indigo w-full mb-2">Central Store</a>
            </div>
            <div class="w-1/2">
                <a href="{{ route('stock.class') }}" class="btn btn-indigo w-full mb-2">Class Storage</a>
            </div>
        </div>
    </div>
</x-app-layout>