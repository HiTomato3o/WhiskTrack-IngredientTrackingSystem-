<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Class</h2>
    </x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('classes.store') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" maxlength="10" class="form-input w-full" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-input w-full" required>
                @error('password')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Semester</label>
                <select name="semester_id" class="form-input w-full" required>
                    <option value="">-- Select Semester --</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->semester_name }} ({{ $semester->academicSession->session_name ?? '' }})</option>
                    @endforeach
                </select>
                @error('semester_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" maxlength="255" class="form-input w-full">
                @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success mt-4">Save</button>
        </form>
    </div>
</x-app-layout>