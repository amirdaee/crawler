<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use DB;
use App\Repositories\User\UserRepositoryContract;
use App\Repositories\Role\RoleRepositoryContract;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class UsersController extends Controller
{
    protected $users;
    protected $roles;
    protected $departments;
    protected $settings;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles

    )
    {
        $this->users = $users;
        $this->roles = $roles;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(20);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name','id');
        return view('users.create',compact('roles','parties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|unique:users',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);
        $user = $this->users->create($request);
        if($user['error']){
            return redirect()->back()
                ->withErrors($user['error']);
        }
        return redirect()->route('users.index')
            ->with('success','کاربر جدید با موفقیت ثبت شد');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $roles = $user->roles;
        $permissions = DB::table('permissions')
            ->join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
            ->join('roles', 'roles.id', '=', 'permission_role.role_id')
            ->whereIn('roles.id',$roles->pluck('id'))
            ->select('permissions.*')
            ->get();
        return view('users.show',compact(['user','roles','permissions']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();

        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|max:256',
            'roles' => 'required',
            'avatar' => 'max:100|mimes:jpeg,png,jpg,gif',
        ]);
        if(!empty($request->password)){
            $this->validate($request, [
                'password' => 'required|min:6|same:confirm-password',
            ]);
        }
        $user = $this->users->update($id,$request);
        if($user['error']){
            return redirect()->back()
                ->withErrors($user['error']);
        }

        return redirect()->route('users.index')
            ->with('success','کار با موفقیت به روز شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            User::find($id)->delete();
            return redirect()->back()
                ->with('success','کاربر با موفقیت حذف شد');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->withErrors('این کاربر را نمی توانید حذف کنید!');
        }
    }

    public function test()
    {
        $user = User::find(1);
        $news = $user->news()->take(10)->get();
        dump($news);
        return;
    }
    
}
