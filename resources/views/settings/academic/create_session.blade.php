<x-app-layout>
    <x-slot name="header">Add Academic Session</x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('settings.academic.session.store') }}">
            @csrf
            <div class="mb-2">
                <label>Session Name</label>
                <input type="text" name="session_name" class="form-input w-full" required>
                @error('session_name')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-input w-full" required>
                @error('start_date')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-input w-full" required>
                @error('end_date')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label><input type="checkbox" name="is_current" value="1"> Set as Current</label>
            </div>
            <button class="btn btn-success">Save</button>
        </form>
    </div>
</x-app-layout>