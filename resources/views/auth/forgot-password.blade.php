<x-layout.basic>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card px-4 py-5">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-1">
                <img src="/images/admin-logo.png" alt="bta! admin"/>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email Address -->
                <x-form.input name="email" class="mb-3" for="email" :required="true" label="Email address" :value="old('email')"/>
                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Email Password Reset Link</button>
            </form>
        </div>
    </div>
</x-layout.basic>
