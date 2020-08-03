@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Uredi korisnika {{ $user->name }}:</div>

                <div class="card-body">
                  <br>
                  <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                      {{-- Laravelov način za korištenje PUT metode --}}
                      @csrf
                      {{ method_field('PUT') }}

                      <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">Ime</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                      {{-- Iteriramo sve uloge kroz petlju--}}
                      <div class="form-group row">
                      <label class="col-md-2 col-form-label text-md-right">Uloge</label>
                        <div class="col-md-6">
                          <br>
                          @foreach ($roles as $role)
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                                    {{-- Provjeravamo je li trenutna uloga dodijeljena korisniku --}}
                                    @if ($user->roles->pluck('id')->contains($role->id)) 
                                        checked 
                                    @endif>
                                    <label>{{ $role->name }}</label>
                                </div>
                          @endforeach
                        </div>
                      </div>
                      {{-- Kraj petlje --}}

                      {{-- Iteriramo sve kolegije kroz petlju--}}
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">Kolegiji</label>
                          <div class="col-md-6">
                            <br>
                            @foreach ($subjects as $subject)
                                  <div class="form-check">
                                      <input type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                                      {{-- Provjeravamo je li trenutni kolegij dodijeljen korisniku --}}
                                      @if ($user->subjects->pluck('id')->contains($subject->id)) 
                                          checked 
                                      @endif>
                                      <label>{{ $subject->name }}</label>
                                  </div>
                            @endforeach
                          </div>
                        </div>
                        {{-- Kraj petlje --}}
                      <button type="submit" class="btn btn-primary float-right">Spremi</button>
                  </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
