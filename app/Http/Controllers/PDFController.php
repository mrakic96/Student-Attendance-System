<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\User;

class PDFController extends Controller
{

    public function PDFGenerator(){
        $subjects = Auth::user()->subjects()->get()->pluck('name', 'id')->all();
        $totalHeldNums = Auth::user()->subjects()->get()->pluck('totalHeld')->all();
        $data = [
            'subjects'     => $subjects,
            'totalHeldNums' => $totalHeldNums
        ];
        $currentUser = Auth::user()->name;
        $pdf = PDF::loadView('pdfview', $data);
        return $pdf->download('Statistika dolaznosti (FSRE) - '.$currentUser.'.pdf');
    }

    public function PDFGeneratorAdmin(User $user){
        $subjects = $user->subjects()->get()->pluck('name', 'id')->all();
        $totalHeldNums = $user->subjects()->get()->pluck('totalHeld')->all();
        $data = [
            'subjects'     => $subjects,
            'totalHeldNums' => $totalHeldNums,
            'user' => $user
        ];
        $currentUser = $user->name;
        $pdf = PDF::loadView('pdfview2', $data);
        return $pdf->download('Statistika dolaznosti (FSRE) - '.$currentUser.'.pdf');

//        Testiranje
//        dd($user->id);
//        dd($user->subjects()->get()->pluck('name', 'id')->all());
    }
}

