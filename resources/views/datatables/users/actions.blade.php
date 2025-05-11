@php(['user'])

<div class="d-flex">
    <a class="me-2" href="{{route('admin.users.edit', ['user' => $user])}}">Manage</a>
    <a class="me-2 danger" href="#" onclick="event.preventDefault(); document.getElementById('change-password-{{$user->id}}').submit();">
        Change Password
    </a>
    <form id="change-password-{{$user->id}}" class="d-none" method="POST" action="{{route('admin.users.request-password-change', ['user' => $user])}}">
        @csrf
    </form>
</div>
