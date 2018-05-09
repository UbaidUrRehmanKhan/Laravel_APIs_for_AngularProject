<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Task as TaskResource;

class TaskController extends Controller
{
    protected function create(Request $request)
    {
       $validatedData = $request->validate([
            'name' => 'required|max:25',
            'description' => 'required'
        ]);
        $task = Task::create([
        'name' => $request->name,
        'description' => $request->description
        ]);
        if(!$task->id){
            $data['errorCode'] = '422';
            $data['name'] = 'Data is not saved';
            return response()->json($data,422);
        }
        return $task->id;

    }


    /**
     * get the Tasks data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTasks()
    {
        $tasks= Task::all();
        return response()->json($tasks);
        
    }
  

    /**
     * get the Tasks data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTask(Task $task)
    {
        // $task= Task::find($id);
        // if(!$task){
        //     $data['title'] = '404';
        //     $data['name'] = 'Page not found';
        //     return response($data);
        // }
        return response()->json($task);
    }

    /**
     * delete the Task data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTask($id)
    {
        $task=Task::find($id);
        if(!$task){
            $data['errorCode'] = '404';
            $data['name'] = 'Page not found';
            return response()->json($data,404);
        }
        if($task->delete()){
            $data['errorCode'] = '200';
            $data['name'] = 'Data is successfully deleted.';
            return response()->json($data,200);
        }
        $data['errorCode'] = '422';
        $data['name'] = 'Data is not Deleted';
        return response()->json($data,422);

        
    }

     /**
     * Updating the Task.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTask(Request $request){
        $task=Task::find($request->id);
        $task->name=$request->name;
        $task->description=$request->description;
        if($task->save()){
            $data['errorCode'] = '200';
            $data['name'] = 'Data is successfully updated.';
            return response()->json($data,200);
        }
        $data['errorCode'] = '304';
        $data['name'] = 'Data is not updated.';
        return response()->json($data,304);
        

    }


    /**
     * getting all the users of a task.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTaskUsers( $id){
        $task=Task::find($id);
        if(!$task){
            $data['errorCode'] = '404';
            $data['name'] = 'Page not found';
            return response()->json($data,404);
        }
        return UserResource::collection($task->users()->get());
        

    }



    /**
     * assigning users to tasks
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function assigningUsers(Request $request, $id){
        $task=Task::find($id);
        
        if(!$task){
            $data['errorCode'] = '404';
            $data['name'] = 'Page not found';
            return response()->json($data,404);
        }
        
        //return response()->json($request->ids);
        if($task->users()->syncWithoutDetaching($request->ids)){
            return response()->json('Task is successfully assigned', 200);
        }
        

    }


     /**
     * Detaching user from a task
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachingUser($userId,$taskId){
        $task=Task::find($taskId);
        if(!$task){
            $data['errorCode'] = '404';
            $data['name'] = 'Page not found';
            return response()->json($data,404);
        }
        return response()->json($task->users()->detach($userId));
        

    }
}
