<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Ingredient Details: {{ $ingredient->name }}</h2>
    </x-slot>
    <div class="max-w-3xl mx-auto py-4 bg-white rounded shadow">
        <div class="mb-4">
            <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this ingredient?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        <table class="table-auto w-full">
            <tr>
                <th class="text-left py-2">Name:</th>
                <td class="py-2">{{ $ingredient->name }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Category:</th>
                <td class="py-2">{{ $ingredient->category->name ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Brand:</th>
                <td class="py-2">{{ $ingredient->brand ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Measurement Type:</th>
                <td class="py-2">{{ $ingredient->measurement_type }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Pack Type Unit:</th>
                <td class="py-2">{{ $ingredient->packTypeUnit->unit_name ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Inner Unit:</th>
                <td class="py-2">{{ $ingredient->innerUnit->unit_name ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Quantity per Pack:</th>
                <td class="py-2">{{ $ingredient->quantity_per_pack ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Weight per Inner Unit:</th>
                <td class="py-2">
                    {{ $ingredient->weight_per_inner_unit ?? '-' }}
                    {{ $ingredient->weightUnitInner->unit_name ?? '' }}
                </td>
            </tr>
            <tr>
                <th class="text-left py-2">Weight Type:</th>
                <td class="py-2">{{ $ingredient->weight_type }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Weight per Pack:</th>
                <td class="py-2">{{ $ingredient->weight_per_pack ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Min/Max Weight per Pack:</th>
                <td class="py-2">{{ $ingredient->min_weight_per_pack ?? '-' }} / {{ $ingredient->max_weight_per_pack ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Unit:</th>
                <td class="py-2">{{ $ingredient->unit->unit_name ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Base Unit:</th>
                <td class="py-2">{{ $ingredient->base_unit }}</td>
            </tr>
            <tr>
                <th class="text-left py-2">Last Updated By:</th>
                <td class="py-2">{{ $ingredient->updater->name ?? '-' }}</td>
            </tr>
        </table>
    </div>
</x-app-layout>