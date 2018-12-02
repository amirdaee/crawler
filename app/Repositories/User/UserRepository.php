<?php
namespace App\Repositories\User;

use App\User;
use App\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Gate;
use Datatables;
use Carbon;
use Auth;
use DB;
use App\Repositories\Party\PartyRepositoryContract;

/**
 * Class UserRepository
 * @package App\Repositories\User
 */
class UserRepository implements UserRepositoryContract
{

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * @return mixed
     */
    public function getAllUsersWithDepartments()
    {
        return User::all()
        ->pluck('nameAndDepartment', 'id');
    }

    /**
     * @param $requestData
     * @return static
     */
    public function create($requestData)
    {
        if($requestData->hasFile('avatar')){
            $requestData->avatar->store('public/avatar');
            $avatar =  $requestData->avatar->hashName();
        }else{
            $avatar = 'man.png';
        }
        $input = $requestData->all();
        $input['password'] = Hash::make($input['password']);
        $input['avatar']=$avatar;
        $input['slug']=str_slug($input['name']);
        $user = User::create($input);
        foreach ($requestData->input('roles') as $key => $value) {
            $user->attachRole($value);
        }
        return $user;
    }

    /**
     * @param $id
     * @param $requestData
     * @return mixed
     */
    public function update($id, $request)
    {
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }
        if($request->hasFile('avatar')){
            $request->avatar->store('public/avatar');
            $input['avatar'] = $request->avatar->hashName();
        }
        $user = User::find($id);
        $user->update($input);
        $user->roles()->sync($request->input('roles'));
        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($request, $id)
    {
//        $user = User::findorFail($id);
//        if ($user->hasRole('super_administrator')) {
//            return Session()->flash('flash_message_warning', 'Not allowed to delete super admin');
//        }
//
//        if ($request->tasks == "move_all_tasks" && $request->task_user != "" ) {
//            $user->moveTasks($request->task_user);
//        }
//        if($request->leads == "move_all_leads" && $request->lead_user != "") {
//            $user->moveLeads($request->lead_user);
//        }
//        if($request->clients == "move_all_clients" && $request->client_user != "") {
//            $user->moveClients($request->client_user);
//        }
//
//        try {
//            $user->delete();
//            Session()->flash('flash_message', 'User successfully deleted');
//        } catch (\Illuminate\Database\QueryException $e) {
//            dd($e);
//            Session()->flash('flash_message_warning', 'User can NOT have, leads, clients, or tasks assigned when deleted');
//        }
    }
}
