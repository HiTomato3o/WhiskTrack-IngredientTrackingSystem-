<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Academic Sessions & Semesters</h2>
    </x-slot>
    <div class="py-4 max-w-5xl mx-auto">
        <a href="{{ route('settings.academic.session.create') }}" class="btn btn-success mb-4">Add Academic Session</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @foreach($sessions as $session)
            <div class="mb-6 p-4 bg-white border rounded shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="font-bold">{{ $session->session_name }}</span>
                        <span class="text-sm text-gray-500">({{ $session->start_date }} - {{ $session->end_date }})</span>
                        @if($session->is_current) <span class="badge badge-success">Current</span> @endif
                    </div>
                    <div>
                        <a href="{{ route('settings.academic.session.edit', $session) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('settings.academic.semester.create', $session) }}" class="btn btn-success">Add Semester</a>
                    </div>
                </div>
                <div class="mt-2">
                    <strong>Semesters:</strong>
                    <ul>
                        @foreach($session->semesters as $semester)
                            <li>
                                {{ $semester->semester_name }} ({{ $semester->start_date }} - {{ $semester->end_date }})
                                <a href="{{ route('settings.academic.semester.edit', $semester) }}" class="btn btn-xs btn-primary">Edit</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>