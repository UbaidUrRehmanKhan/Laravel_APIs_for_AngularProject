<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Task as TaskResource;
use App\Task_User;
use App\User;
use App\Task;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected function create(Request $request)
    {
        
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'isActive' => $request->isActive, 
        'isAdmin'  => $request->isAdmin
        ]);
        if(!$user->id){
            $data['errorCode'] = '422';
            $data['name'] = 'Data is not saved';
            return response($data);
        }
        return $user->id;

    }


    /**
     * get the users data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        $users= User::where('isAdmin',0)->get();
        return response()->json($users);
    }


    /**
     * get the user data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($id)
    {
        $user=User::find($id);
        if(!$user){
            $data['errorCode'] = '404';
            $data['name'] = 'Data not found.';
            return response($data,404);
        }

        $user->taskCompleted =  $user->tasks()->where('status',1)->count();
        $user->taskOngoing =  $user->tasks()->where('status',0)->count();
        return response()->json($user);
    }


    /**
     * Updating the User.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request){
        $user=User::find($request->id);
        $user->name=$request->name;
        $user->isActive=$request->isActive;
        $user->email=$request->email;
        $user->isAdmin=$request->isAdmin;
        if($user->save()){
            $data['errorCode'] = '200';
            $data['name'] = 'Data is successfully updated.';
            return response()->json($data,200);
        }
        $data['errorCode'] = '304';
        $data['name'] = 'Data is not updated.';
        return response()->json($data,304);
        

    }



    /**
     * Updating the User status.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUserStatus($id, $status){
        $user=User::find($id);
        $user->isActive=$status;
        if($user->save()){
            $data['errorCode'] = '200';
            $data['name'] = 'Data is successfully updated.';
            return response()->json($data,200);
        }
        $data['errorCode'] = '304';
        $data['name'] = 'Data is not updated.';
        return response()->json($data,304);
        

    }


    /**
     * getting all the tasks assigned to a user.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserTasks( $id){
        $user=User::find($id);
        if(!$user){
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response($data);
        }

        return TaskResource::collection($user->tasks()->get());
        

    }

    /**
     * getting a task assigned to a user.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserTask( $userId, $taskId){
        $user=User::find($userId);
        if(!$user){
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response($data,404);
        }
        
        return new TaskResource($user->tasks()->where('task_id',$taskId)->first());
        

    }



    /**
     * updating the task status assigned to a user.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTaskStatus($userId, $taskId){
        $user=User::find($userId);
        if(!$user){
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response($data,404);
        }
        
        return $user->tasks()->updateExistingPivot($taskId, ['status' => 1]);
        

    }
}
