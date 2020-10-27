<?php

namespace App\Http\Controllers;

use App\StatusGroup;
use App\StatusGroupUser;
use Illuminate\Http\Request;

class StatusGroupController extends Controller
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
            $statsGroup =New StatusGroup();
            $statsGroup->user_id = $request->user_id;
            $statsGroup->name = $request->name;
            $statsGroup->save();
            foreach($request->users as $user)
            {
                $statusGroupView = New StatusGroupUser();
                $statusGroupView->user_id = $user;
                $statusGroupView->status_group_id = $statsGroup->id;
                $statusGroupView->save();;

            }
            $data['message'] = $statsGroup;
            return  $this->apiResponse($data,200);
         }catch(\Exception $e){
             $data['message'] = 'error';
             return  $this->apiResponse($data,404);
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StatusGroup  $statusGroup
     * @return \Illuminate\Http\Response
     */
    public function show(StatusGroup $statusGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatusGroup  $statusGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusGroup $statusGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusGroup  $statusGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusGroup $statusGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusGroup  $statusGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusGroup $statusGroup)
    {
        //
    }
}
