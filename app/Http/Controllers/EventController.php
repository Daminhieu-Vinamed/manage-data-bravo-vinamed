<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function happyBirthday()
    {
        $name = Auth::user()->name;
        return view('event.happy-birthday', compact('name'));
    }
}