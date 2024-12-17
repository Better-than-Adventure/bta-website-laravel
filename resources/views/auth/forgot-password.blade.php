<x-layout.basic>
    <div class="my-3 text-center">
        Enter your email address to be sent a password reset link
    </div>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <!-- Email Address -->
        <x-form.input name="email" class="mb-3" for="email" :required="true" label="Email address" :value="old('email')"/>
        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100 mt-3">Email Password Reset Link</button>
    </form>
</x-layout.basic>
