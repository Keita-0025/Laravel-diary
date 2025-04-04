<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyCompleteController extends Controller
{
    public function show()
    {
        return view('auth.verify-success');
    }
}
