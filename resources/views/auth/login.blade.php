<x-layout.basic>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card px-4 py-5">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-1">
                <img src="/images/admin-logo.png" alt="bta! admin"/>
            </div>
            <h2 class="mb-5">Login to Admin Portal</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <x-form.input name="email" class="mb-3" for="email" :required="true" label="Email address" />
                <!-- Password -->
                <x-form.input name="password" class="mb-3" type="password" for="password" :required="true" label="Password"/>
                <!-- Forgotten & Remember Me -->
                <a class="mb-3" href="#">Forgot password?</a>
                <x-form.checkbox id="remember-me" label="Remember me"/>
                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
            </form>
        </div>
    </div>
</x-layout.basic>
