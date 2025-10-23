<x-app-layout>
    <x-slot name="header">
        <h2>Edit User</h2>
    </x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Full Name</label>
                <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}" class="form-input w-full" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-input w-full" required>
            </div>
            <div>
                <label>Role</label>
                <select name="role_id" class="form-input w-full" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>ID (Student/Lecturer/Admin)</label>
                <input type="text" name="student_lecturer_admin_id" value="{{ old('student_lecturer_admin_id', $user->student_lecturer_admin_id) }}" class="form-input w-full">
            </div>
            <div>
                <label>New Password <span class="text-gray-500">(leave blank to keep current password)</span></label>
                <input type="password" name="password" class="form-input w-full">
            </div>
            <div>
                <label>Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-input w-full">
            </div>
            <button type="submit" class="btn btn-success mt-4">Update User</button>
        </form>
    </div>
</x-app-layout>