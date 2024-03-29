<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Rolesmodel;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         // $this->middleware('permission:role-list');
          $this->middleware('permission:role_create', ['only' => ['create','store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $keyword = $request->get('search');
        if (!empty($keyword)) {
            $roles = Rolesmodel::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate(5);
            
        } else {
            $roles = Rolesmodel::orderBy('id','DESC')->latest()->paginate(5);
     }
    
        return view('Roles.index',compact('roles'))
               ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /** Create Role **/
    public function create()
    {
        $permission = Permission::get();
        return view('Roles.create',compact('permission'));
    }

     /** Store Role **/
     public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
      $role = Rolesmodel::create(['name' => $request->input('name')]);
      return redirect()->route('Roles.index')
                       ->with('success','Role created successfully');
    }
     
      /** Show Role **/
     public function show($id)
    {
        $role = Rolesmodel::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return view('Roles.show',compact('role','rolePermissions'));
    }

     /** Edit Role **/
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('Roles.edit',compact('role','permission','rolePermissions'));
    }

     /** Update Role **/
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('Roles.index')
                        ->with('success','Role updated successfully');
    }
    
     /** Delete Role **/
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('Roles.index')
                         ->with('success','Role deleted successfully');
    }

  }