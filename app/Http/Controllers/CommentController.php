<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $post = Post::find($data['post_id']);
            unset($data['post_id']);
            $comment = Comment::create($data);
            $post->comment()->save($comment);
            $data['data'] = Comment::with('user')->withCount('favouriteomment ')->where('id',$comment->id)->first();
            $data['message'] = 'create';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        try{
            $data['data'] = $comment;
            $data['message'] = 'edit';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        try{
            $data = $request->all();
            $comment = $comment->update($data);
            $data['data'] = $comment;
            $data['message'] = 'update';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try{
            $comment = $comment->delete();
            $data['data'] = $comment;
            $data['message'] = 'delete';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }
}
