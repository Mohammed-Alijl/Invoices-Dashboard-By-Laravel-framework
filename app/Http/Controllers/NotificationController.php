<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\DisplayRequest;
use App\Http\Requests\Notification\MarkAllRequest;
use App\Http\Requests\Notification\RealTimeRequest;

class NotificationController extends Controller
{
    public function markAllAsRead(MarkAllRequest $request)
    {
        return $request->run();
    }
    public function display(DisplayRequest $request,$id){
        return $request->run($id);
    }
    public function displayRealTime(RealTimeRequest $request,$id){
        return $request->run($id);
    }
}
