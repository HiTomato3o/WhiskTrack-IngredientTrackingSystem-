<x-app-layout>
    <x-slot name="header">Units</x-slot>
    <div class="py-4 max-w-3xl mx-auto">
        <a href="{{ route('settings.units.create') }}" class="btn btn-success mb-4">Add Unit</a>
        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Abbreviation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($units as $unit)
                    <tr>
                        <td>{{ $unit->unit_name }}</td>
                        <td>{{ $unit->abbreviation }}</td>
                        <td>
                            <a href="{{ route('settings.units.edit', $unit) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('settings.units.destroy', $unit) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this unit?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-8">No units found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">{{ $units->links() }}</div>
    </div>
</x-app-layout>