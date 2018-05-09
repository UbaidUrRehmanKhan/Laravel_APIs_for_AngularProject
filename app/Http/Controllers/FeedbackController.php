<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Feedback;
use App\Task;

class FeedbackController extends Controller
{
    protected function createFeedback(Request $request,User $user,Task $task)
    {
        //Route model binding
        $validatedData = $request->validate([
             'description' => 'required|max:100',
            
         ]);
         $feedback = Feedback::create([
            'description' => $request->description,
            'user_id' => $user->id,
            'task_id' => $task->id
         ]);
         if(!$feedback->id){
             $data['errorCode'] = '422';
             $data['name'] = 'Data is not saved';
             return response($data);
         }
         return $feedback;
 
    }



    /**
     * delete the feedback data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFeedback($id)
    {
        $feedback=Feedback::find($id);
        if(!$feedback){
            $data['errorCode'] = '404';
            $data['name'] = 'Page not found';
            return response()->json($data, 400);
        }
        if($feedback->delete()){
            $data['errorCode'] = '200';
            $data['name'] = 'Data is successfully deleted.';
            return response()->json($data, 200);
        }
        $data['errorCode'] = '422';
        $data['name'] = 'Data is not Deleted';
        return response()->json($data, 422);

        
    }


    protected function viewFeedbacks(User $user,Task $task)
    {
        
        $feedbacks= $user->feedbacks()->where('task_id',$task->id)->get();
        return response()->json($feedbacks);
    }


}
