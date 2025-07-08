<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view users')->only('index');
        $this->middleware('permission:edit users')->only(['edit', 'update']);
        // $this->middleware('permission:delete users')->only('destroy');
    }

    /**
     * Show all users with roles
     */
    // UserController.php
public function index()
{
    $users = User::with('roles')->latest()->paginate(); // ✅ eager load
    return view('users.list', compact('users'));
}

    

// public function create()
// {
//     $roles = Role::orderBy('name','ASC')->get();
//     return view('users.create' ,[
//         'roles' => '$roles'

//     ]);
// }

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;

public function create()
{
    $roles = Role::all(); // ✅ Collection of roles
    $permissions = Permission::all(); // ✅ Collection of permissions

    return view('users.create', compact('roles', 'permissions'));
}


// public function create()
// {
//     $roles = Role::all(); // this returns a Collection (which works with foreach)

//     return view('users.create', compact('roles'));
// }


public function edit($id)
{
    $user = User::findOrFail($id);
    $roles = Role::orderBy('name')->get();
    $permissions = Permission::orderBy('name')->get();

    return view('users.edit', compact('user', 'roles', 'permissions'));
}

   

public function show($id)
{
    // Just redirect or abort if not needed
   
}

// public function store(Request $request)
// {

//  $validator = Validator::make($request->all(),[
//         'name' => 'required|min:3',
//         'email' => 'required|email|unique:users,email',
//         'password' => 'required|min:5|same:confirm_password',
//         'confirm_password' => 'required',
//     ]);

//    if($validator->fail()){
//          return redirect()->route('users.create')->withInput()->withErrors($validator);

//     }
//     $user = new User();
//     $user->name = $request->name;
//     $user->email = $request->email;
//     $user->password = Hash::make($request->password);
//     $user->save();

//    $user->sycnRoles($request->role);

//     return redirect()->route('users.index')->with('success', 'User added successfully!');

   
// }


// public function store(Request $request)
// {
//     $validated = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email',
//         'password' => 'required|confirmed|min:6',
//     ]);


    


//     $user = User::create([
//         'name' => $validated['name'],
//         'email' => $validated['email'],
//         'password' => Hash::make($validated['password']),
//     ]);

//     if ($request->has('roles')) {
//         $user->syncRoles($request->roles); // role IDs
//     }

//     if ($request->has('permissions')) {
//         $user->syncPermissions($request->permissions); // permission names
//     }

//     return redirect()->route('users.index')->with('success', 'User created successfully.');
// }

public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:6',
        'roles'    => 'nullable|array',
        'permissions' => 'nullable|array',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    if ($request->has('roles')) {
        $user->syncRoles($request->roles); // expects role names
    }

    if ($request->has('permissions')) {
        $user->syncPermissions($request->permissions); // expects permission names
    }

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}

// public function update(Request $request, $id)
// {
//     $request->validate([
//         'name' => 'required|string|min:3',
//         'roles' => 'nullable|array',
//         'permissions' => 'nullable|array',
//     ]);

//     $user = User::findOrFail($id);
//     $user->name = $request->name;
//     $user->save();

//     if ($request->has('roles')) {
//         $user->syncRoles($request->roles);
//     }

//     if ($request->has('permissions')) {
//         $user->syncPermissions($request->permissions);
//     }

//     return redirect()->route('users.index')->with('success', 'User updated successfully!');
// }

// public function update(Request $request, $id)
// {
//     $request->validate([
//         'name' => 'required|string|min:3',
//         'roles' => 'nullable|array',
//         'permissions' => 'nullable|array',
//     ]);

//     $user = User::findOrFail($id);
//     $user->name = $request->name;
//     $user->email = $request->email; // If email is editable
//     $user->save();

//     if ($request->has('roles')) {
//         $roleNames = \Spatie\Permission\Models\Role::whereIn('id', $request->roles)->pluck('name')->toArray();
//         $user->syncRoles($roleNames);
//     } else {
//         $user->syncRoles([]);
//     }

//     if ($request->has('permissions')) {
//         $user->syncPermissions($request->permissions);
//     } else {
//         $user->syncPermissions([]);
//     }

//     return redirect()->route('users.index')->with('success', 'User updated successfully.');
// }

public function update(Request $request, $id)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email,' . $id,
        'roles'    => 'nullable|array',
        'permissions' => 'nullable|array',
    ]);

    $user = User::findOrFail($id);

    $user->update([
        'name'  => $request->name,
        'email' => $request->email,
    ]);

    if ($request->has('roles')) {
        $user->syncRoles($request->roles); // expects role names
    } else {
        $user->syncRoles([]); // remove all roles if none checked
    }

    if ($request->has('permissions')) {
        $user->syncPermissions($request->permissions);
    } else {
        $user->syncPermissions([]); // remove all permissions if none checked
    }

    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}


    /**
     * Delete user (if needed)
     */
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();
    //     return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    // }


     public function destroy(User $user)
{
    $user->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'User deleted successfully.',
    ]);


// if($user == null){
// session()->flash('error', 'user not found ');
//    return response()->json([
//      'status' => false
//     ]);
// }
//     $user->delete();

//     session()->flash('error','user deleted successfully');
//     return response ()->json([
//      'status' => 'true'
//     ]);
    
}
}
