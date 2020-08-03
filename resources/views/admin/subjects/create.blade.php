@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novi kolegij</div>

                <div class="card-body">
                  <br>
                  <form action="{{ route('admin.subjects.store') }}" method="POST">
                      @csrf

                      <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label text-md-right">Naziv</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus>

                            @error('name')
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
