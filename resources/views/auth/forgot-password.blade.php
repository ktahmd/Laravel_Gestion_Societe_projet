<x-guest-layout>
    <div class="form-group">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>
<br>
    

    <form class="form-auth-small" method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="control-label sr-only">{{ __('Email') }}</label>
            <input id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
            @if ($errors->has('email'))
                <span class="mt-2" style="color: red;">{{ $errors->first('email') }}</span>
            @endif
        </div>
        

        <div class="form-group">
            <x-primary-button class="btn btn-success btn-lg btn-block">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
            
        </div>
    </form>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" style="color: rgb(1, 208, 84);"/>
</x-guest-layout>
