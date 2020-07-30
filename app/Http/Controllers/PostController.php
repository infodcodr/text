<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Images;
use Storage;
use Illuminate\Http\Request;

class PostConroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if (isset($request->user_id)) {
                $user = User::find($request->user_id);
                if(!$user){
                    $data['message'] = 'No User Found';
                    return  $this->apiResponse($data, 404);
                }
                $posts = $user->posts()->with(['user','images','favouriteUser','comment','comment.user'])->withCount('favourite', 'comment')->orderBy('id','desc')->paginate(8);
            } else {
                $user = auth()->user();
                $posts = $user->posts()->with(['user','images','favouriteUser','comment','comment.user'])->withCount('favourite', 'comment')->orderBy('id','desc')->paginate(8);
            }
            $data['data'] = $posts;
            $data['message'] = 'lists';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = $e->getMessage();
            return  $this->apiResponse($data, 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
           $post = Post::create($data);
            if ($request->has('files')) {
                foreach ($data['files'] as $file) {

                    $image = New Images();
                    $image->name = $file;
                    $image->post_id = $post->id;
                    $image->save();
                    $post->images()->save($image);
                }
            }
                if(isset($data['base64Image']))
                {
                    foreach ($data['base64Image'] as $images) {
                    $imageName = $this->createImage($images);
                    $imageBase = New Images();
                    $imageBase->name = $imageName;
                    $imageBase->post_id = $post->id;
                    $imageBase->save();
                    $post->images()->save($imageBase);

                    }
                }

            $user = auth()->user();
            $user->timeline()->save($post);
            $data['data'] = Post::with('user','images')->withCount('favourite', 'comment')->where('id',$post->id)->first();
            $data['message'] = 'create';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {

            $data['message'] = $e->getMessage()." " .$e->getLine()." ".$e->getFile();
            return  $this->apiResponse($data, 404);
        }
    }
    public function uploadImages(Request $request)
    {
        try{
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                    $filenameWithExt = $file->getClientOriginalName();

                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $file->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    // Upload Image
                    $file->storeAs('public/files', $fileNameToStore);


            }
            $data['message'] = $fileNameToStore;
            return  $this->apiResponse($data, 200);
        }catch(\Exception $e){
            $data['message'] = $e->getMessage()." " .$e->getLine()." ".$e->getFile();
            return  $this->apiResponse($data, 404);
        }
    }
    public function createImage($img)
    {

        $image = $img;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        //$image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        Storage::put('public/files/'.$imageName, base64_decode($image));
       return $imageName;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $Request,$id)
    {
        try {
            $data['data'] = Post::with('user','images')->withCount('favourite', 'comment')->where('id',$id)->first();;
            $data['message'] = 'edit';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = 'error';
            return  $this->apiResponse($data, 404);
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

        try {
            $data = $request->all();
            $post = $post->update($data);
            $data['data'] = $post;
            $data['message'] = 'update';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = 'error';
            return  $this->apiResponse($data, 404);
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
        try {
            $post = $post->delete();
            $data['data'] = $post;
            $data['message'] = 'delete';
            return  $this->apiResponse($data, 200);
        } catch (\Exception $e) {
            $data['message'] = 'error';
            return  $this->apiResponse($data, 404);
        }
    }
}
