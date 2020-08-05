<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $subjects = Auth::user()->subjects()->get()->pluck('name')->all();
        $totalHeldNums = Auth::user()->subjects()->get()->pluck('totalHeld')->all();
        return view('profile')->with([
            'subjects' => $subjects,
            'totalHeldNums' => $totalHeldNums
        ]);
    }


}
