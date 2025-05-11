<?php

namespace App\Http\Controllers\admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function index()
    {
        $dataTable = new UserDataTable();
        return $dataTable->render('admin.users.list');
    }

    public function create()
    {
        $user = new User;
        return view('admin.users.create-edit')->with(compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|max:255|unique:users,name',
            'roles' => 'required',
            'roles.*' => 'required|max:255|exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Str::random(),
        ]);

        $roles = $validated['roles'];
        $user->roles()->detach();

        foreach ($roles as $role) {
            $user->roles()->attach($role);
        }

        return redirect(route('admin.users'));

    }

    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);
        return view('admin.users.create-edit')->with(compact('user'));
    }

    public function requestPasswordChange(User $user)
    {
        $token = app(PasswordBroker::class)->createToken($user);
        $url = config('app.url')."/reset-password/$token?email={$user->email}";
        return redirect(route('admin.users'))->with(['reset-token' => "$url"]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required|max:255|unique:users,name,'.$user->id,
            'roles' => 'required',
            'roles.*' => 'required|max:255|exists:roles,id',
        ]);

        $user = User::findOrFail($user->id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email']
        ]);

        $roles = $validated['roles'];
        $user->roles()->detach();

        foreach ($roles as $role) {
            $user->roles()->attach($role);
        }


        return redirect(route('admin.users'));
    }
}
