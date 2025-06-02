<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list', ['only' => ['getUserList']]);
        $this->middleware('permission:role-create', ['only' => ['getUserForm', 'storeUser']]);
        $this->middleware('permission:role-edit', ['only' => ['editUser', 'updateUser']]);
        $this->middleware('permission:role-delete', ['only' => ['deleteUser']]);
    }

    public function getUserList()
    {
        $users = User::all(); // User::get();
        return view('user.index', compact('users'));
    }
    public function getUserForm()
    {
        $users = User::all(); // User::get();
        return view('user.create', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $validateData =  $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['string', 'max:255'],
            'phone' => ['string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'fname:required' => 'The First Name field is required!',
            'fname:max' => 'The First Name field lenght must not be greater than 255 characters!',
        ]);

        // dd($validateData);
        User::create($validateData);
        return redirect()->route('user.index')->with('status', 'User data stored successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('status', 'User deleted successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        // dd($request->all(),$id);
        $validateData =  $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['string', 'max:255'],
            'phone' => ['string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ], [
            'fname:required' => 'The First Name field is required!',
            'fname:max' => 'The First Name field lenght must not be greater than 255 characters!',
        ]);
        $user = User::findOrFail($id);
        $user->update($validateData);
        return redirect()->route('user.index')->with('status', 'User updated successfully.');
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
