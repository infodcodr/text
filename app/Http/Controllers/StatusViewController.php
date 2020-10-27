<?php

namespace App\Http\Controllers;

use App\StatusGroup;
use App\StatusView;
use Illuminate\Http\Request;

class StatusViewController extends Controller
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
           $statsGroup =New StatusView();
           $statsGroup->user_id = $request->user_id;
           $statsGroup->status_id = $request->status_id;
           $statsGroup->view_date = date('Y-m-d H:i:s');
           $statsGroup->save();
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
     * @param  \App\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function show(StatusView $statusView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function edit(StatusView $statusView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StatusView $statusView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StatusView  $statusView
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusView $statusView)
    {
        //
    }
}
