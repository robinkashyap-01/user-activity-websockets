<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    
class BroadcastController extends Controller
{
    public function authenticate(Request $request)
    {
        if (!Auth::check()) {
            return response('Unauthorized', 401);
        }

        return response()->json(['id' => Auth::id(), 'name' => Auth::user()->name]);
    }
}
