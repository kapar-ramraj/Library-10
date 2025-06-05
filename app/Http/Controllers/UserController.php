<?php

namespace App\Http\Controllers;

use App\Mail\SendUserCredentials;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['getUserList']]);
        $this->middleware('permission:user-create', ['only' => ['getUserForm', 'storeUser']]);
        $this->middleware('permission:user-edit', ['only' => ['editUser', 'updateUser']]);
        $this->middleware('permission:user-delete', ['only' => ['deleteUser']]);
    }

    public function getUserList()
    {
        $users = User::with('roles')->get(); // User::get();
        return view('user.index', compact('users'));
    }
    public function getUserForm()
    {
        $users = User::all(); // User::get();
        $roles = Role::all();
        return view('user.create', compact('users', 'roles'));
    }

    public function storeUser(Request $request)
    {
        $validateData =  $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['string', 'max:255'],
            'phone' => ['string', 'max:20'],
            'role_name' => ['nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'user_type' => ['required']
        ], [
            'fname:required' => 'The First Name field is required!',
            'fname:max' => 'The First Name field lenght must not be greater than 255 characters!',
        ]);

        // dd($validateData);
        $userPassword = $validateData['password'];
        $validateData['password'] = Hash::make($validateData['password']);
        $user = User::create($validateData);
        if (!empty($validateData['role_name'])) {
            $user->assignRole($validateData['role_name']);
        }
        // Send email with credentials
        Mail::to($user->email)->send(new SendUserCredentials($user->email, $userPassword, $user->fname.' '.$user->lname));

        return redirect()->route('user.index')->with('success', 'User data stored successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $useAssignedRole = $user->roles->pluck('name')->toArray();
        return view('user.edit', ['user' => $user, 'roles' => $roles, 'useAssignedRole' => $useAssignedRole]);
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all(),$id);
        $validateData =  $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['string', 'max:255'],
            'phone' => ['string', 'max:20'],
            'role_name' => ['nullable'],
            'user_type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ], [
            'fname:required' => 'The First Name field is required!',
            'fname:max' => 'The First Name field lenght must not be greater than 255 characters!',
        ]);
        $user = User::findOrFail($id);
        $user->update($validateData);

        if (!empty($validateData['role_name'])) {
            $user->assignRole($validateData['role_name']);
        }
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function changePassword()
    {
        return view('user.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // If validation passes, update the password
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}
