<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {

        return $dataTable->render('common.index',[
            'resourceName'=>'Users',
            'resourceRoute'=>'users',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.form');
    }

    public function store(UserRequest $request)
    {


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),


        ]);

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.view', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully.');
    }
}
