@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Korisnici
                <a href="{{ route('admin.users.create') }}"><button type="button" class="btn btn-primary btn float-right" title="Novi korisnik"><i class="fas fa-user-plus"></i></button></a>

                </div>
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Administratori</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.profesori') }}">Profesori</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">Studenti</a>
                  </li>
                </ul>
                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ime</th>
                            <th scope="col">Email</th>
                            <th scope="col">Uloga/e</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                          </tr>
                        </thead>
                        <tbody>
                        {{-- Iteriramo sve usere kroz petlju --}}
                        @foreach ($users as $user)
                          <tr>
                            @if ($user->hasRole('admin'))

                              <th scope="row">{{ $user->id }}</th>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                              <td>
                                  <a href="{{ route('admin.users.profile', $user->id) }}"><button type="button" class="btn btn-primary float-left" title="Informacije o korisniku" style="margin-right: 2px;"><i class="far fa-eye"></i></button></a>
                              </td>
                              <td>
                                  <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left" title="Uredi korisnika" style="margin-right: 2px;"><i class="far fa-edit"></i></button></a>
                              </td>
                              <td>
                                  <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                      @csrf
                                      {{ method_field('DELETE') }}
                                      <button type="submit" class="btn btn-danger" title="Izbriši korisnika"><i class="far fa-trash-alt"></i></button>
                                  </form>
                              </td>
                            @endif
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
