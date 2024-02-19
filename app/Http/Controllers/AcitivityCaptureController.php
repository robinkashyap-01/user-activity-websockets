<?php

namespace App\Http\Controllers;

use App\Events\UserStatus;
use Illuminate\Http\Request;

class AcitivityCaptureController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        event(new UserStatus('active', $user->id));
    }
}
