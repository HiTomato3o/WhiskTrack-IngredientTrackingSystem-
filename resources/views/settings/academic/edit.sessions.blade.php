<x-app-layout>
    <x-slot name="header">Edit Academic Session</x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('settings.academic.session.update', $session) }}">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label>Session Name</label>
                <input type="text" name="session_name" class="form-input w-full" value="{{ old('session_name', $session->session_name) }}" required>
                @error('session_name')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-input w-full" value="{{ old('start_date', $session->start_date) }}" required>
                @error('start_date')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-input w-full" value="{{ old('end_date', $session->end_date) }}" required>
                @error('end_date')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>
                    <input type="checkbox" name="is_current" value="1" {{ old('is_current', $session->is_current) ? 'checked' : '' }}>
                    Set as Current
                </label>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
</x-app-layout>