@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo predavanje</div>

                <div class="card-body">
                  <br>
                  <form action="{{ route('attendances.store') }}" method="POST">
                      @csrf

                      <div class="form-group row">
                        <label for="description" class="col-md-2 col-form-label text-md-right">Opis predavanja</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="" required autofocus>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="date" class="col-md-2 col-form-label text-md-right">Datum</label>

                        <div class="col-md-6">
                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="" required autofocus>

                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="subject" class="col-md-2 col-form-label text-md-right">Kolegij</label>
                        <div class="col-md-6">

                            <select name="subject" class="form-control" id="">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                            </select>
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

