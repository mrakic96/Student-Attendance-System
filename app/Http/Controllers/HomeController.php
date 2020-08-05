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
        $subjects = Auth::user()->subjects()->get()->pluck('name', 'id')->all();
        $totalHeldNums = Auth::user()->subjects()->get()->pluck('totalHeld')->all();
        $userAttendances = Auth::user()->attendances()->get()->all();
        return view('profile')->with([
            'subjects' => $subjects,
            'totalHeldNums' => $totalHeldNums
        ]);
//        dd(Auth::user()->attendances()
//                        ->where('attendance', 'da')
//                        ->where('subject_id', '1')
//                        ->get()
//                        ->all());
//        dd(Auth::user()->subjects()->get()->pluck('name', 'id')->all());
//        dd(\App\Subject::where('name', 'Matematika 1')->get()->pluck('id')->first());
    }

}
