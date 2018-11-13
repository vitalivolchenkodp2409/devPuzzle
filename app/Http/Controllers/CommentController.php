<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get comments 
        $comments = Comment::all();

        //return collection of comments as a resource
        return CommentResource::collection($comments);
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = $request->isMethod('put') ? Comment::findOrFail 
        ($request->comment_id) : new Comment;

        $comment->id = $request->input('comment_id');
        $comment->name = $request->input('name');
        $comment->position = $request->input('position');
        $comment->firma = $request->input('firma');
        $comment->comment = $request->input('comment');

        if($comment->save()) {
            return new CommentResource($comment);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get comment
        $comment = Comment::findOrFail($id);

        // return single comment as a resource
        return new CommentResource($comment);
    }    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get comment
        $comment = Comment::findOrFail($id);

        if($comment->delete()) {
        return new CommentResource($comment);
        }
    }
}
