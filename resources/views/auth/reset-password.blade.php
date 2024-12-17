<x-layout.basic>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card px-4 py-5">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-1">
                <img src="/images/admin-logo.png" alt="bta! admin"/>
            </div>
            <div class="mb-4">
                {{ __('Enter details to reset password.') }}
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <x-form.input name="email" class="mb-3" for="email" :required="true" label="Email address" :value="old('email', $request->email)"/>
                <!-- Password -->
                <x-form.input name="password" class="mb-3" type="password" for="password" :required="true" label="New Password"/>
                <!-- Password Re-entry-->
                <x-form.input name="password_confirmation" class="mb-3" type="password" for="password_confirmation" :required="true" label="Confirm New Password"/>
                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Reset Password</button>
            </form>
        </div>
    </div>
</x-layout.basic>
