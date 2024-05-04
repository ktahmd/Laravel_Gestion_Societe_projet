<section>
    <header>
        <h2>
            {{ __('Update Password') }}
        </h2>

    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
    
        <div class="form-group">
            <x-input-label  for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control{{ $errors->updatePassword->has('current_password') ? ' is-invalid' : '' }}" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" style="color: red;" />
        </div>
    
        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="form-control{{ $errors->updatePassword->has('password') ? ' is-invalid' : '' }}" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" style="color: red;" />
        </div>
    
        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control{{ $errors->updatePassword->has('password_confirmation') ? ' is-invalid' : '' }}" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" style="color: red;" />
        </div>
    
        <div class="flex items-center gap-4">
            <x-primary-button class="btn btn-success">{{ __('Save') }}</x-primary-button>
    
            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    
</section>
