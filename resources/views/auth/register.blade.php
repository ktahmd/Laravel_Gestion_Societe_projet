<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="form-auth-small">
        @csrf

        <!-- Username -->
        <div class="form-group">
            <label for="username" class="control-label sr-only">Username</label>
            <input type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" value="{{ old('username') }}" required placeholder="Username">
            <x-input-error :messages="$errors->get('username')" class="mt-2" style="color: red;" />
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="control-label sr-only">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red;" />
        </div>

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="control-label sr-only">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email">
            <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red;" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="control-label sr-only">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="Password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red;" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" class="control-label sr-only">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="block mt-1 w-full form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red; display: block;" />
        </div>



        <!-- Role -->
        <div class="form-group">
            <x-input-label class="control-label sr-only" for="role" :value="__('Role')" />

            <div class="mt-2">
                <label for="staff" class="inline-flex items-center">
                    <input id="staff" type="radio" class="form-radio" name="role" value="staff">
                    <span class="ml-2">Staff</span>
                </label>

                <label for="admin" class="inline-flex items-center ml-6">
                    <input id="admin" type="radio" class="form-radio" name="role" value="admin">
                    <span class="ml-2">Admin</span>
                </label>
            </div>

            <x-input-error :messages="$errors->get('role')" class="mt-2" style="color: red;" />
        </div>

        <div>
            <x-primary-button class="btn btn-success btn-lg btn-block">
                {{ __('Register') }}
            </x-primary-button>
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>

