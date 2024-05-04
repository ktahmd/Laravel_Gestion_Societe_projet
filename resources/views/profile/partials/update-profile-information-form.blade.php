<section>
    <header>
        <h2 >
            {{ __('Update Profile Information') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
    
        
        <div class="form-group">
            <x-input-label class="control-label sr-only" for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" style="color: red;" />
        </div>
    
        <div class="form-group">
            <x-input-label class="control-label sr-only" for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" style="color: red;" />
    
        </div>
    
        <div class="form-group">
            <x-primary-button class="btn btn-success  ">{{ __('Save') }}</x-primary-button>
    
            @if (session('status') === 'profile-updated')
                <p style="color: rgb(15, 130, 25);"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >{{ __('Saved') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div><br><br>
                <p class="text-sm mt-2 text-red-800" style="color: red;">
                    {{ __('Your email address is unverified.') }}
                </p>

                    <button form="send-verification"  >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif
        </div>
    </form>
    
</section>
