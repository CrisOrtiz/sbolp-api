<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\CommentTransformer;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Comment;
use App\Models\User;
use Artisan;



class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comments = Comment::where('content','LIKE','%'.$request->search.'%')
        ->where('clinic_case_id', $request->clinic_case_id)
        ->orderBy('isRead')            
        ->paginate((int)$request->pageSize);

        return response()->json(compact(['comments']),200);
    }

     /**
     * Display a listing of the resource according id.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUserComments(Request $request)
    {
        $comments = Comment::where('content','LIKE','%'.$request->search.'%')
        ->where('user_id', $request->user_id)
        ->orderBy('isRead')
        ->paginate((int)$request->pageSize);

        return $this->collection($comments, new CommentTransformer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id)->with('user');

        if (!$comment) {
            return response()->json(['Comentario inexistente'], 400);
        }

        return $this->item($comment, new CommentTransformer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->clinic_case_id = $request->clinic_case_id;
        $comment->content = $request->content;
        $comment->owner = "Dr. ".$user->name." ".$user->lastname;
        $comment->isRead = $request->isRead;
        $comment->save();

        return $this->item($comment, new CommentTransformer);
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
        $comment = Comment::findOrFail($id);
        $comment->user_id = $request->user_id;
        $comment->clinic_case_id = $request->clinic_case_id;
        $comment->content = $request->content;
        $comment->isRead = $request->isRead;
        $comment->save();

        return $this->item($comment, new CommentTransformer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        $text = "Comentario eliminado";

        return response()->json(compact('text'), 200);
    }

    public function changeStatus(Request $request)
    {
        $status = 'Mark as read failed';

        $comment = Comment::where('id', $request->id)->first();
        if($request->isRead == false){
            $comment->isRead = true;
        }elseif($request->isRead == true){
            $comment->isRead = false;
        }       
        $comment->save();

        if ($comment->save()) {
            $status = 'Success';    
            return response()->json(compact(['comment', 'status']), 200);
        } else {
            $message = 'Comment mark as read failed';
            return response()->json(compact('status', 'message'), 401);
        }
    }
}
