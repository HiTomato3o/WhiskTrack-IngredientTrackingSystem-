<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard</h2>
    </x-slot>
    <div class="py-10 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            @if(auth()->user()->role->name === 'Admin' || auth()->user()->role->name === 'Lecturer')
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold mb-2">Classes</h3>
                    <p>Manage, enroll, and view all classes.</p>
                    <a href="{{ route('classes.index') }}" class="btn btn-primary mt-2">View Classes</a>
                </div>
            @endif
            @if(auth()->user()->role->name === 'Admin')
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold mb-2">User Management</h3>
                    <a href="{{ route('users.index') }}" class="btn btn-info mt-2">Users</a>
                    <a href="{{ route('users.approval') }}" class="btn btn-info mt-2 ml-2">User Approvals</a>
                </div>
            @endif
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="font-bold mb-2">Ingredients</h3>
                <p>View and manage ingredients records.</p>
                <a href="{{ route('ingredients.index') }}" class="btn btn-primary mt-2">View Ingredients</a>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="font-bold mb-2">Stock</h3>
                <p>Monitor and transfer stock.</p>
                <a href="{{ route('stock.index') }}" class="btn btn-primary mt-2">View Stock</a>
            </div>
            @if(auth()->user()->role->name === 'Admin')
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold mb-2">Settings</h3>
                    <a href="{{ route('settings.units.index') }}" class="btn btn-info mt-2">Units</a>
                    <a href="{{ route('settings.unit_types.index') }}" class="btn btn-info mt-2 ml-2">Unit Types</a>
                    <a href="{{ route('settings.categories.index') }}" class="btn btn-info mt-2 ml-2">Categories</a>
                    <a href="{{ route('settings.academic.index') }}" class="btn btn-info mt-2 ml-2">Academic</a>
                </div>
            @endif
            @if(auth()->user()->role->name === 'Student')
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold mb-2">My Classes</h3>
                    <a href="{{ route('classes.index') }}" class="btn btn-primary mt-2">View My Classes</a>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <h3 class="font-bold mb-2">Profile</h3>
                    <a href="{{ route('profile.show') }}" class="btn btn-info mt-2">View Profile</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>