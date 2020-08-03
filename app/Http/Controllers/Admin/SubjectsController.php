<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Gate;

class SubjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Subject::create(['name' => $request->name]);

        return redirect(route('admin.subjects.index'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.subjects.index'));
        }

        return view('admin.subjects.edit')->with('subject', $subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->name = $request->name;

        if($subject->save()){
            $request->session()->flash('success', 'Kolegij "'.$subject->name.'" je uspješno ažuriran.');
        } else {
            $request->session()->flash('error', 'Došlo je do greške pri ažuraciji');
        }
        

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.subjects.index'));
        }

        $subject->delete();

        return redirect()->route('admin.subjects.index');
    }
}
