<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostConroller extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $post = Post::create($data);
            $data['data'] = $post;
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        try{
            $data['data'] = $post;
            $data['message'] = 'edit';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        try{
            $data = $request->all();
            $post = $post->update($data);
            $data['data'] = $post;
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try{
            $post = $post->delete();
            $data['data'] = $post;
            $data['message'] = 'delete';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }
}
