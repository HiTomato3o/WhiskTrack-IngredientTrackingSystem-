<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">User Management</h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="GET" class="mb-4 flex gap-2">
                <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-2"/>
                <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-2"/>
                <select name="role" class="border rounded px-2">
                    <option value="">All Roles</option>
                    <option value="Admin">Admin</option>
                    <option value="Lecturer">Lecturer</option>
                    <option value="Student">Student</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
            <a href="{{ route('users.create') }}" class="btn btn-success mb-2">Add User</a>
            @if(session('success'))
                <div class="alert alert-success mb-2">{{ session('success') }}</div>
            @endif
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>ID Number</th>
                        <th>Role</th>
                        <th>Register Date</th>
                        <th>Last Login</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->student_lecturer_admin_id }}</td>
                            <td>{{ $user->role->abbreviation }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i') : '-' }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Remove user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>