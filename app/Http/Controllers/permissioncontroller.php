<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Permission;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permissions')->only('index');
        $this->middleware('permission:create permissions')->only(['create', 'store']);
        $this->middleware('permission:edit permissions')->only(['edit', 'update']);
        $this->middleware('permission:delete permissions')->only('destroy');
    }

    // public function index()
    // {
    //     $permissions = Permission::with('roles')->orderBy('created_at', 'ASC')->get();
    //     return view('permissions.list', compact('permissions'));
    // }




//     public function index()
//     {
//         $permissions = Permission::with('roles')->get(); // or paginate(10)
//         return view('permissions.list', compact('permissions'));
    
// }
// use Spatie\Permission\Models\Permission;



public function index()
{
    $permissions = Permission::with('roles')->get(); // ✅ important!
    return view('permissions.list', compact('permissions'));
}



    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission added successfully.');
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validator);
        }
    }
// PermissionController.php me yeh method add karo
public function show($id)
{
    $permission = Permission::findOrFail($id);
    return view('permissions.list', compact('permission'));
}

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id
        ]);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        } else {
            return redirect()->route('permissions.edit', $id)->withInput()->withErrors($validator);
        }
    }

//    public function destroy(Request $request)
// {
//     $permission = Permission::find($request->id);

//     if (!$permission) {
//         return response()->json(['status' => false, 'message' => 'Permission not found']);
//     }

//     $permission->delete();

//     session()->flash('success', 'Permission deleted successfully.');
//     return response()->json(['status' => true]);

// }
// }


// public function destroy(Request $request)
// {
//     $permission = Permission::find($request->id);

//     if (!$permission) {
//         return response()->json(['status' => false, 'message' => 'Permission not found']);
//     }

//     $permission->delete();

//     return response()->json(['status' => true, 'message' => 'Permission deleted successfully.']);
// }


public function destroy(Request $request)
{
    $permission = Permission::find($request->id);

    if (!$permission) {
        return response()->json(['status' => false, 'message' => 'Permission not found']);
    }

    $permission->delete();

    return response()->json(['status' => true, 'message' => 'Permission deleted successfully']);
}

}
