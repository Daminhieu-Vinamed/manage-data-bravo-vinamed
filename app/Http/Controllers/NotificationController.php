<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected NotificationService $notificationService;
    protected AuthService $authService;

    public function __construct(NotificationService $notificationService, AuthService $authService)
    {
        $this->notificationService = $notificationService;
        $this->authService = $authService;
    }
    
    public function list() 
    {
        return view('notification.list');
    }
    
    public function getData()
    {
        return $this->notificationService->getData();
    }

    public function listViewAdditionalWorkAndOnLeave(Request $request) 
    {
        $this->authService->markAsRead($request->notification_id);
        return view('notification.list-additional-work-and-on-leave');
    }

    public function listDataAdditionalWorkAndOnLeave(Request $request) 
    {
        return $this->notificationService->listDataAdditionalWorkAndOnLeave($request->id);
    }
}