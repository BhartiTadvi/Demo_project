<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Rolesmodel;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
        
class UserController extends Controller
{
     /**
      Display a listing of the user.
     **/
     public function index(Request $request)
    { 
      
        $keyword = $request->get('search');
       if (!empty($keyword)) {
        
       $data = User::where('name', 'LIKE', "%$keyword%")->latest()->paginate(5);
       }
       else {
         $data = User::where('name', 'LIKE', "%$keyword%")->orWhere('id','!=',Auth::user()->id)->latest()->paginate(5);
      }
      
      return view('Users.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /** Create User **/
    public function create()
    {
        $roles = Rolesmodel::pluck('name','name')->all();
        // dd($roles);
        return view('Users.create',compact('roles'));
    }

    /** Store user into database **/
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password',
            'roles' => 'required',
            'image' => 'required'
        ]);
        $input = $request->all();
         if ($request->hasFile('image')) {
        $input['image'] = $request->file('image')
                            ->store('uploads', 'public');
        }
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('Users.index')
                        ->with('success','User created successfully');
    }

    /** Show specific user **/
     public function show($id)
    {
        $user = User::find($id);
        return view('Users.show',compact('user'));
    }

     /** Edit specific user **/
     public function edit($id)
    {
        $user = User::find($id);
        $roles = Rolesmodel::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->first();
        return view('Users.edit',compact('user','roles','userRole'));
    }

    /** Update specific user **/
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $image = $request->image;
        $input = $request->all();
         if ($request->hasFile('image')) 
        {
            $input['image'] = $request->file('image')
                        ->store('uploads', 'public');
        }
        $user = User::find($id);
    
        if($request->password == null){
         $user->update($request->except('password','confirmPassword'));
         } 
         else{
             $user->update($request->except('confirmPassword'));
         }
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('Users.index')
                        ->with('success','User updated successfully');
    }

    /** Delete specific user **/
    public function destroy($id)
    {
      User::find($id)->delete();
      return redirect()->route('Users.index')->with('success','User deleted successfully');
    }
}

