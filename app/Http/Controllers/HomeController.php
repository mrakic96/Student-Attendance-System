<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;


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
    public function index(User $user)
    {
        $user = Auth::user();
        return view('home')->with("user", $user);
    }

    public function profile()
    {
        $subjects = Auth::user()->subjects()->get()->pluck('name', 'id')->all();
        $totalHeldNums = Auth::user()->subjects()->get()->pluck('totalHeld')->all();

        return view('profile')->with([
            'subjects' => $subjects,
            'totalHeldNums' => $totalHeldNums
        ]);

/*        Testiranja */
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//        dd(Auth::user()->attendances()
//                        ->where('attendance', 'da')
//                        ->where('subject_id', '1')
//                        ->get()
//                        ->all());
//        dd(Auth::user()->getAttribute('name'));


    }

}
