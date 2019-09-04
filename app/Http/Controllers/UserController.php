<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Rolesmodel;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
        //  $role = Rolesmodel::where('name', '=', 'customer')->firstOrFail();
        //  $user->attachRole($role);
        // //  $role = Rolesmodel::where('name', 'customer')->first();
         //$user->assignRole($role);
class UserController extends Controller
{

        public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('Users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $roles = Rolesmodel::pluck('name','name')->all();
        return view('Users.create',compact('roles'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
             'confirm-password' => 'required|same:password',
            'roles' => 'required',
            'image' => 'required'
        ]);
         $input = $request->all();
         // dd($input);
         if ($request->hasFile('image')) {
        //$image = $request->file('image');
        $input['image'] = $request->file('image')
                            ->store('uploads', 'public');
        

    }
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('Users.create')
                        ->with('success','User created successfully');
    }
  
     public function show($id)
    {
        $user = User::find($id);
        return view('Users.show',compact('user'));
    }

     public function edit($id)
    {
        $user = User::find($id);
        $roles = Rolesmodel::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('Users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
      // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        // dd($input);
         if ($request->hasFile('image')) 
        {
            $input['image'] = $request->file('image')
                        ->store('uploads', 'public');
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole($request->input('roles'));


        return redirect()->route('Users.index')
                        ->with('success','User updated successfully');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('Users.index')
                        ->with('success','User deleted successfully');
    }





    

 



    


}

