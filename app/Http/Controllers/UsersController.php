<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected function create(Request $request)
    {
       //var_dump($request);
       $validatedData = $request->validate([
            'name' => 'required|max:25',
            'email' => 'required',
            'password' => 'required',
            'isActive'  => 'required',
            'isAdmin'   => 'required'
        ]);
        $user = User::createUser([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'isActive' => 1,
        'isAdmin'  => 0
        ]);
        return $user->id;

    }

    /**
     * get the user data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        $users= User::where('isAdmin',0)->where('isActive',1)->get();
        return response()->json($users);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request){
        $user=User::find($request->id);
        if(!$user){
            return "false";
        }
        $user->name=$request->name;
        $user->isActive=$request->isActive;
        if($user->save()){
            return "true";
        }
        return "false";
        

    }

}
