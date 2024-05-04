<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form class="form-auth-small" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="form-group">
                <x-primary-button class="btn btn-success btn-lg btn-block">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
                
            </div>
            
        </form>
        @if (session('status') == 'verification-link-sent')
        <div  class="mb-4 font-medium text-sm text-green-600 dark:text-green-400" style="color: rgb(1, 208, 84);">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
        @endif
        

        <form class="form-auth-small" method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="form-group">
                <x-primary-button type="submit" >
                    {{ __('Log out') }}
                </x-primary-button>
                
            </div>
           
        </form>
    </div>
</x-guest-layout>
