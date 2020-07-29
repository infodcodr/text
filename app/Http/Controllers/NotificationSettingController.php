<?php

namespace App\Http\Controllers;

use App\NotificationSetting;
use Illuminate\Http\Request;

class NotificationSettingController extends Controller
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
            $user = auth()->user();
            $notificationSetting = $user->notificationSetting;
            if(!$notificationSetting)
            {
                $notificationSetting = New NotificationSetting();
                $notificationSetting->user_id = auth()->user()->id;
            }
            $notificationSetting->{$request->type} = ($notificationSetting->{$request->type})?false:true;
            $notificationSetting->save();
            $data['message'] = 'updated';
            return  $this->apiResponse($data,200);
        }catch(\Exception $e)
        {
            $data['message'] = 'error';
            return  $this->apiResponse($data,404);
        }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NotificationSetting  $notificationSetting
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationSetting $notificationSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NotificationSetting  $notificationSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(NotificationSetting $notificationSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NotificationSetting  $notificationSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NotificationSetting $notificationSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NotificationSetting  $notificationSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationSetting $notificationSetting)
    {
        //
    }
}
