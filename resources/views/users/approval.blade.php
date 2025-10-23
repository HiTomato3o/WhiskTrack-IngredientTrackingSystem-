<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">User Approval</h2>
    </x-slot>
    <div class="max-w-4xl mx-auto mt-6">
        <form method="GET" class="mb-4 flex gap-2">
            <input type="date" name="from" value="{{ request('from') }}" class="border rounded px-2"/>
            <input type="date" name="to" value="{{ request('to') }}" class="border rounded px-2"/>
            <select name="role" class="border rounded px-2">
                <option value="">All Roles</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Student">Student</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        @if(session('success'))
            <div class="alert alert-success mb-2">{{ session('success') }}</div>
        @endif
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>ID Number</th>
                    <th>Register Date</th>
                    <th>Approve</th>
                    <th>Disapprove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pendingUsers as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->abbreviation }}</td>
                        <td>{{ $user->student_lecturer_admin_id }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <form method="POST" action="{{ route('users.approve', $user) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('users.disapprove', $user) }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">Disapprove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-2">{{ $pendingUsers->links() }}</div>
    </div>
</x-app-layout>