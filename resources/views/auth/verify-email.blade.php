<x-layout.basic>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card px-4 py-5">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-1">
                <img src="/images/admin-logo.png" alt="bta! admin"/>
            </div>
            <div class="mb-4">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-success">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Resend Verification Email</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-outline-primary w-100 mt-1">Logout</button>
            </form>
        </div>
    </div>
</x-layout.basic>
