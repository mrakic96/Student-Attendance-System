@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            
            <div class="card">
                
                <div class="card-header">Korisnici
                <a href="{{ route('admin.users.create') }}"><button type="button" class="btn btn-primary btn-sm float-right">Novi korisnik</button></a>

                </div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Email</th>
                            <th scope="col">Uloga/e</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        {{-- Iteriramo sve usere kroz petlju --}}
                        @foreach ($users as $user)
                          <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            <td>
                                {{-- BUTTONS --}}
                                <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Uredi</button></a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Izbriši</button>
                                </form>
                            </td>
                          </tr>
                        @endforeach
                        {{-- Kraj petlje --}}
                        </tbody>
                      </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
