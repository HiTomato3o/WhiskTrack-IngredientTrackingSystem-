<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Full Name -->
        <div>
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" maxlength="128" required autofocus />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role Dropdown -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full" required>
                <option value="">Select Role</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Student">Student</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Student/Lecturer ID -->
        <div class="mt-4">
            <x-input-label for="student_lecturer_admin_id" :value="__('Lecturer/Student ID')" />
            <x-text-input id="student_lecturer_admin_id" class="block mt-1 w-full" type="text" name="student_lecturer_admin_id" maxlength="24" required />
            <x-input-error :messages="$errors->get('student_lecturer_admin_id')" class="mt-2" />
        </div>

        <!-- Password & Confirm -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Sign up') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>