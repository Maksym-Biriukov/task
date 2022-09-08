<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function history()
    {
        $id = Auth::id();
        $sessions = Session::where('id_manager', $id)->get();
        return view('sessions_history', ['sessions' => $sessions]);
    }
}
