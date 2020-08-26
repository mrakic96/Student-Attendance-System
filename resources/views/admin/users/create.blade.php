@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novi korisnik</div>

                <div class="card-body">
                  <br>
                  <form action="{{ route('admin.users.store') }}" method="POST">
                      @csrf

                      <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">Ime</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus>

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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-md-2 col-form-label text-md-right">Lozinka</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                      {{-- Iteriramo sve uloge kroz petlju--}}
                      <div class="form-group row">
                      <label class="col-md-2 col-form-label text-md-right">Uloga</label>
                        <div class="col-md-6">                          
                          <select name="roles" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                            </select>
                        </div>
                      </div>
                      {{-- Kraj petlje --}}

                      {{-- Iteriramo sve kolegije kroz petlju--}}
                      <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">Kolegiji</label>
                          <div class="col-md-6">                           
                            <select name="subjects[]" class="form-control" id="slect2subjects" multiple="multiple">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                            </select>
                          </div>
                        </div>
                        {{-- Kraj petlje --}}
                      <div class="form-group row">
                          <label for="index" class="col-md-2 col-form-label text-md-right">Indeks</label>

                          <div class="col-md-6">
                              <input title="xxxx/rr" id="index" type="text" class="form-control @error('index') is-invalid @enderror" name="index" value="" autofocus>

                              @error('index')
                              <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                          </div>
                      </div>


                      <button type="submit" class="btn btn-primary float-right">Spremi</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
    $('#slect2subjects').select2();
    
});
    </script>
@endpush