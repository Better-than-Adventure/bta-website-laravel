@props(['user'])

<x-layout.admin>
    <div>
        <h2>@if($user->exists) Manage @else Create @endif User Profile</h2>
        <hr/>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
        <form method="POST" enctype="multipart/form-data" class="row" action="{{ $user->exists ? route('admin.users.update', ['user' => $user]) : route('admin.users.store') }}">
            @csrf
            <div class="col-md-12">
                <x-form.input class="mb-3" label="Username" name="name" required="true" value="{{old('name', $user->name)}}" placeholder="Enter Username"/>
                <x-form.input class="mb-3" label="Email Address" type="email" name="email" required="true" value="{{old('email', $user->email)}}" placeholder="Enter Email Address"/>
                @php
                    $roles = \Spatie\Permission\Models\Role::all();
                @endphp
                <div>Manage Roles</div>
                @foreach($roles as $role)
                    <x-form.checkbox id="role-{{$role->id}}" value="{{$role->id}}" checked="{{$user->hasRole($role->name) ?? false}}" name="roles[]" label="{{$role->name}}"/>
                @endforeach
                <button type="submit" name="action" class="btn btn-primary mt-3">Register User</button>
            </div>
        </form>
    </div>
</x-layout.admin>
