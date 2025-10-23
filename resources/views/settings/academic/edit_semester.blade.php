<x-app-layout>
    <x-slot name="header">Edit Semester</x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('settings.academic.semester.update', $semester) }}">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label>Semester Name</label>
                <input type="text" name="semester_name" class="form-input w-full" value="{{ old('semester_name', $semester->semester_name) }}" required>
                @error('semester_name')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-input w-full" value="{{ old('start_date', $semester->start_date) }}" required>
                @error('start_date')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div class="mb-2">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-input w-full" value="{{ old('end_date', $semester->end_date) }}" required>
                @error('end_date')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
</x-app-layout>