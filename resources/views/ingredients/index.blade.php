<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Ingredients</h2>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto">
        <a href="{{ route('ingredients.create') }}" class="btn btn-success mb-4">Add Ingredient</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Measurement Type</th>
                    <th>Pack Info</th>
                    <th>Unit</th>
                    <th>Base Unit</th>
                    <th>Last Updated</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($ingredients as $ingredient)
                <tr>
                    <td>{{ $ingredient->name }}</td>
                    <td>{{ $ingredient->category->name ?? '-' }}</td>
                    <td>{{ $ingredient->brand ?? '-' }}</td>
                    <td>{{ $ingredient->measurement_type }}</td>
                    <td>
                        @if($ingredient->measurement_type == 'Pack-based')
                            @if($ingredient->innerUnit)
                                {{ $ingredient->packTypeUnit->unit_name ?? '-' }} ({{ $ingredient->quantity_per_pack }} {{ $ingredient->innerUnit->unit_name ?? '-' }} x {{ number_format($ingredient->weight_per_inner_unit, 2) }} {{ $ingredient->weightUnitInner->unit_name ?? '-' }})
                            @elseif($ingredient->weight_type == 'Fixed')
                                {{ $ingredient->packTypeUnit->unit_name ?? '-' }} - {{ number_format($ingredient->weight_per_pack, 2) }} {{ $ingredient->unit->unit_name ?? $ingredient->base_unit }}
                            @elseif($ingredient->weight_type == 'Ranged')
                                {{ $ingredient->packTypeUnit->unit_name ?? '-' }} ({{ number_format($ingredient->min_weight_per_pack, 2) }} - {{ number_format($ingredient->max_weight_per_pack, 2) }}) {{ $ingredient->unit->unit_name ?? $ingredient->base_unit }}
                            @else
                                {{ $ingredient->packTypeUnit->unit_name ?? '-' }}
                            @endif
                        @else
                            {{ $ingredient->unit->unit_name ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $ingredient->unit->unit_name ?? '-' }}</td>
                    <td>{{ $ingredient->base_unit }}</td>
                    <td>
                        @if($ingredient->updater)
                            {{ $ingredient->updated_at->format('d/m/Y H:i') }} by 
                            {{
                                \Illuminate\Support\Str::before(
                                    \Illuminate\Support\Str::replace([' bin ', ' binti '], '', $ingredient->updater->name),
                                    ' ', 2
                                )
                            }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('ingredients.show', $ingredient) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this ingredient?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center text-gray-500 py-8">No ingredients found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="mt-2">
            {{ $ingredients->links() }}
        </div>
    </div>
</x-app-layout>