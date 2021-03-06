<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Gate;
use DataTables;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subject::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="subjects/'.$row->id.'/edit" class="edit btn btn-primary btn-sm"><i class="far fa-edit"></i></a>';
                           $btn = $btn. '&nbsp;&nbsp;<a href="subjects/'.$row->id.'/delete" class="edit btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.subjects.index');
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


    public function delete(Subject  $subject)
    {
        return view('admin.subjects.delete')->with([
            'subject' => $subject,
        ]);
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

        $subject->attendances()->delete();
        $subject->users()->detach();
        $subject->delete();

        return redirect()->route('admin.subjects.index');
    }
}
