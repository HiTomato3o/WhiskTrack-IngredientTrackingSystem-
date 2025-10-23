<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Student Classes</h2>
    </x-slot>
    <div class="py-10 max-w-5xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="font-bold text-lg mb-4">Your Enrolled Classes</h3>
            <!-- Example: List classes for this student. Replace with your actual data logic. -->
            @if(isset($classes) && count($classes))
                <ul>
                    @foreach($classes as $class)
                        <li class="mb-2">{{ $class->name }} ({{ $class->semester->semester_name ?? '-' }})</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">You are not enrolled in any class.</p>
            @endif
            <a href="{{ route('classes.index') }}" class="btn btn-primary mt-4">View All Classes</a>
        </div>
    </div>
</x-app-layout>