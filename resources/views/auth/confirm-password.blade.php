<x-layout.basic>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="card px-4 py-5">
        <div class="card-body">
            <div class="d-flex justify-content-center mb-1">
                <img src="/images/admin-logo.png" alt="bta! admin"/>
            </div>
            <div class="mb-4">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <x-form.input name="password" class="mb-3" type="password" for="password" :required="true" label="New Password"/>
                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Confirm</button>
            </form>
        </div>
    </div>
</x-layout.basic>
