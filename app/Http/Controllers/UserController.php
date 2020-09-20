<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $data = $request->all();
            $user = auth()->user();
            $user = User::find(auth()->user()->id);
            if(isset($data['profile'])){
            $user->profile =  $data['profile'] ;
            }
            if(isset($data['cover'])){
            $user->cover =$data['cover'];
            }
            if(isset($data['name'])){
            $user->name = $data['name'];
            }
            $user->save();
            $data['message'] = 'update';
            $data['data'] = $user;
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow(Request $request)
    {
        try{
            $uid = $request->id;
            $user = User::find($uid);
            auth()->user()->toggleFollow($user);
            $data['message'] = 'follow';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data,404);
        }
    }

    public function accept(Request $request)
    {
        try{
            $uid = $request->id;
            $user = User::find($uid);
            auth()->user()->acceptFollowRequestFrom($user);
            $data['message'] = 'follow';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }
    public function reject(Request $request)
    {
        try{
            $uid = $request->id;
            $user = User::find($uid);
            auth()->user()->rejectFollowRequestFrom($user);
            $data['message'] = 'follow';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }

    public function removeAccount(Request $request)
    {
        try{
            auth()->user()->delete();
            $data['message'] = 'remove user';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }

    public function profileUpload(Request $request)
    {
        try{
            $files = $request->all();
            $data['message'] = $files;
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }
    public function search(Request $request,$key)
    {
        try{
            $search = $key;
            $users = User::where('name','like','%'.$search.'%')->get();
            foreach($users as $user){
                $user->isFollowing = auth()->user()->isFollowing($user);
                $user->requestedFollowing = auth()->user()->hasRequestedToFollow($user);
            }


            $data['message'] = $users;
            return  $this->apiResponse($data,200);
        }catch(\Exception $e){
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }
}
