// Check if default Superadmin and Admin users exist in db else insert
$userList = User::get()->pluck('email','id')->toArray();
//dd($userList);
$faker = Faker\Factory::create();
$role = Role::where('role_key','superadmin')->first();
if($userList)
{
$temp = strtolower($defaultUsername);
if(!in_array($temp, array_map('strtolower',$userList)))
{
$insert= array('name' => $faker->firstname,

'email' => $temp,
'password' => Hash::make('admin123'));
$userId = \DB::table('users')->insertGetId($insert);
//dd($userId);
$roles = RoleUser::create([
'user_id' => $userId,
'role_id' => $role->id,
]); 

}

}
else{

$temp = strtolower($defaultUsername);
$insert= array('name' => $faker->firstname,

'email' => $temp,
'password' => Hash::make('admin123'));
$userId = \DB::table('users')->insertGetId($insert);
// dd('userId');
$roles = RoleUser::create([
'user_id' => $userId,
'role_id' => $role->id,
]); 
}