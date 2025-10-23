<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add User</h2>
    </x-slot>
    <div class="max-w-lg mx-auto mt-6">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div>
                <label>Full Name</label>
                <input type="text" name="full_name" maxlength="128" class="form-input w-full" required/>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" maxlength="255" class="form-input w-full" required/>
            </div>
            <div>
                <label>Role</label>
                <select name="role_id" class="form-input w-full" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>ID Number</label>
                <input type="text" name="student_lecturer_admin_id" maxlength="24" class="form-input w-full"/>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" class="form-input w-full" required/>
            </div>
            <div>
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input w-full" required/>
            </div>
            <button type="submit" class="btn btn-success mt-4">Sign Up</button>
        </form>
    </div>
</x-app-layout>