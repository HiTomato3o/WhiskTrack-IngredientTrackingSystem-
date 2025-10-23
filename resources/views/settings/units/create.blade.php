<x-app-layout>
    <x-slot name="header">Add Unit</x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('settings.units.store') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="unit_name" class="form-input w-full" required>
                @error('unit_name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Abbreviation</label>
                <input type="text" name="abbreviation" class="form-input w-full">
                @error('abbreviation')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success mt-4">Save</button>
        </form>
    </div>
</x-app-layout>