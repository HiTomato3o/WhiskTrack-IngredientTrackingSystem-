<x-app-layout>
    <x-slot name="header">Enroll User in {{ $class->name }}</x-slot>
    <div class="max-w-xl mx-auto mt-6">
        <form method="POST" action="{{ route('classes.enroll', $class) }}">
            @csrf
            <label>User</label>
            <select name="user_id" class="form-input w-full mb-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->full_name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            <button class="btn btn-success">Enroll</button>
        </form>
        <h3 class="mt-6 font-bold">Enrolled Users</h3>
        <ul>
            @foreach($class->users as $user)
                <li>
                    {{ $user->full_name }} ({{ $user->email }})
                    <form method="POST" action="{{ route('classes.remove', $class) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button class="btn btn-danger btn-xs" onclick="return confirm('Remove this user?')">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>