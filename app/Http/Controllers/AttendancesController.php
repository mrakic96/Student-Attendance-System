<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
// use App\Role;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendance::all();
        return view('attendances.index')->with('attendances', $attendances);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::all();
        return view('attendances.create')->with([
            'subjects' => $subjects
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = User::all();
        $attendance = Attendance::create([
            'description' => $request->description,
            'date' => $request->date,
            'subject_id' => $request->subject
        ]);
        DB::table('subjects')->where('id', $attendance->subject_id)->increment('totalHeld');
        return view('attendances.createattendance')->with([
            'attendance'=> $attendance,
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {

    }

    public function storeattendance(Request $request, Attendance $attendance)
    {

        foreach($request->attendance as $key => $value) {
            DB::insert('insert into attendance_user (attendance_id, user_id, attendance) values (?, ?, ?)',
            [$attendance->id, $key, $value]);
        }

        return redirect()->route('attendances.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        $subjects = Subject::all();
        return view('attendances.edit')->with([
            'subjects' => $subjects,
            'attendance' => $attendance
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        $attendance->description = $request->description;
        $attendance->date = $request->date;
        $attendance->subject_id = $request->subject;


        if($attendance->save()){
            $request->session()->flash('success', 'Predavanje je uspješno ažurirano.');
        } else {
            $request->session()->flash('error', 'Došlo je do greške pri ažuraciji');
        }


        return redirect()->route('attendances.index');
    }

    public function editattendance (Attendance $attendance){
        $users = User::all();
        return view('attendances.editattendance')->with([
            'attendance' => $attendance,
            'users' => $users
        ]);
//        dd(DB::table('attendance_user')
//            ->where(['attendance_id' => 1, 'user_id' => 4])
//            ->select('attendance'));
//        dd(DB::table('attendance_user')
//            ->select('attendance')
//            ->where(['attendance_id' => 1, 'user_id' => 4])->get()->pluck('attendance')->first());

    }

    public function updateattendance (Request $request, Attendance $attendance){

        foreach($request->attendance as $key => $value) {
            DB::table('attendance_user')
                ->where(['attendance_id' => $attendance->id, 'user_id' =>  $key])
                ->update([
                    'attendance_id' => $attendance->id,
                    'user_id' => $key,
                    'attendance' => $value,
                ]);
        }

        return redirect()->route('attendances.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        DB::table('subjects')->where('id', $attendance->subject_id)->decrement('totalHeld');
        DB::table('attendance_user')->where('attendance_id', $attendance->id)->delete();

        return redirect()->route('attendances.index');
    }

}
