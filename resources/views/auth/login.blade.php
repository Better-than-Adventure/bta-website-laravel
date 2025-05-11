<x-layout.basic>
    <h2 class="mb-5 text-center">Login to BTA! Workbench</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <x-form.input name="email" class="mb-3" for="email" :required="true" label="Email address" />
        <!-- Password -->
        <x-form.input name="password" class="mb-3" type="password" for="password" :required="true" label="Password"/>
        <!-- Forgotten & Remember Me -->
        <x-form.checkbox id="remember" name="remember" label="Remember me"/>
        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
    </form>
</x-layout.basic>
