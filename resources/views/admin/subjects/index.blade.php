@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            
            <div class="card">
                
                <div class="card-header">Kolegiji
                <a href="{{ route('admin.subjects.create') }}"><button type="button" class="btn btn-primary btn float-right" title="Novi kolegij"><i class="fas fa-plus"></i></button></a>

                </div>

                <div class="card-body">
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        {{-- Iteriramo sve kolegije kroz petlju --}}
                        @foreach ($subjects as $subject)
                          <tr>
                            <th scope="row">{{ $subject->id }}</th>
                            <td>{{ $subject->name }}</td>
                            <td>
                                {{-- BUTTONS --}}
                                <a href="{{ route('admin.subjects.edit', $subject->id) }}"><button type="button" class="btn btn-primary float-left" title="Uredi kolegij" style="margin-right: 5px;"><i class="far fa-edit"></i></button></a>
                                <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="float-left">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" title="Izbriši kolegij"><i class="far fa-trash-alt"></i></button>
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
