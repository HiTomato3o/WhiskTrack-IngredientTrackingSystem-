<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Class Storage Stock</h2>
    </x-slot>
    <div class="py-4 max-w-7xl mx-auto">
        @foreach($classStocks as $classId => $stocks)
            <div class="bg-gray-100 rounded p-4 mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <strong>Class ID:</strong> {{ $classId }}
                    </div>
                    <a href="{{ route('stock.class.view', $classId) }}" class="btn btn-indigo">View</a>
                </div>
                <div>
                    <span class="font-semibold">Total Ingredients:</span> {{ $stocks->count() }}
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>