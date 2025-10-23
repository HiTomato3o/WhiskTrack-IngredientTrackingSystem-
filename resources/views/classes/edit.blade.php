<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Class</h2>
    </x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('classes.update', $class) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" maxlength="10" class="form-input w-full" value="{{ old('name', $class->name) }}" required>
                @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>New Password <span class="text-gray-500">(leave blank to keep current)</span></label>
                <input type="password" name="password" class="form-input w-full">
                @error('password')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Semester</label>
                <select name="semester_id" class="form-input w-full" required>
                    <option value="">-- Select Semester --</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ $class->semester_id == $semester->id ? 'selected' : '' }}>
                            {{ $semester->semester_name }} ({{ $semester->academicSession->session_name ?? '' }})
                        </option>
                    @endforeach
                </select>
                @error('semester_id')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" maxlength="255" class="form-input w-full" value="{{ old('description', $class->description) }}">
                @error('description')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success mt-4">Update</button>
        </form>
    </div>
</x-app-layout>