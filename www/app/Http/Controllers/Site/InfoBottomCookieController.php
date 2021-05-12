<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InfoBottomCookieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function accept()
    {
        return response()->json(['status' => 'success'])->cookie('site-info-bottom-cookie-accept', true, 60 * 24 * 14);
    }
}
