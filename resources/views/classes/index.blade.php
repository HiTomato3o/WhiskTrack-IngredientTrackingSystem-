<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Class List</h2>
    </x-slot>
    <div class="py-4 max-w-5xl mx-auto">
        <a href="{{ route('classes.create') }}" class="btn btn-success mb-4">Add Class</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Semester</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>
                            {{ $class->semester->semester_name ?? '-' }}
                            @if($class->semester && $class->semester->academicSession)
                                ({{ $class->semester->academicSession->session_name }})
                            @endif
                        </td>
                        <td>{{ $class->description ?? '-' }}</td>
                        <td>{{ $class->creator->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('classes.edit', $class) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this class?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-8">No classes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-2">{{ $classes->links() }}</div>
    </div>
</x-app-layout>