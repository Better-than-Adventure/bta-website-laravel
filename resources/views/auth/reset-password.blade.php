<x-layout.basic>
    <div class="mb-4">
        {{ __('Enter details to reset password.') }}
    </div>
    <form method="POST" action="{{ route('password.store') }}">
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
</x-layout.basic>
