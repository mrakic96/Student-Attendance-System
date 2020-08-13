<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Subject;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;


class UsersController extends Controller
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
        if(Gate::denies('see-users')){
            return redirect(route('admin.users.index'));
        }
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.users.index');
    }
    public function profesori()
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $users = User::all();
        return view('admin.users.profesori')->with('users', $users);
    }
    public function administratori()
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $users = User::all();
        return view('admin.users.administratori')->with('users', $users);
    }

    public function profile(User $user)
    {
        if(Gate::denies('see-users')){
            return redirect(route('admin.users.index'));
        }

        $subjects = $user->subjects()->get()->pluck('name', 'id')->all();
        $totalHeldNums = $user->subjects()->get()->pluck('totalHeld')->all();

        return view ('admin.users.profile')->with([
            'user' => $user,
            'subjects' => $subjects,
            'totalHeldNums' => $totalHeldNums
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();
        $subjects = Subject::all();
        return view('admin.users.create')->with([
            'roles' => $roles,
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
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'index' => $request->index
        ]);

        $user->roles()->sync($request->roles);
        $user->subjects()->sync($request->subjects);

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $roles = Role::all();
        $subjects = Subject::all();

        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'subjects' => $subjects
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $user->roles()->sync($request->roles);
        $user->subjects()->sync($request->subjects);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()){
            $request->session()->flash('success', 'Korisnik "'.$user->name.'" je uspješno ažuriran.');
        } else {
            $request->session()->flash('error', 'Došlo je do greške pri ažuraciji');
        }


        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        $user->roles()->detach();
        $user->subjects()->detach();
        $user->attendances()->detach();

        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
