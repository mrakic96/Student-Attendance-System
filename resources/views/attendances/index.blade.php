@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Predavanja
                <a href="{{ route('attendances.create') }}"><button type="button" class="btn btn-primary btn float-right" title="Novo predavanje"><i class="fas fa-plus"></i></button></a>

                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Kolegij</th>
                            <th scope="col">Opis</th>
                            <th scope="col">Datum</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                        {{-- Iteriramo sva predavanja kroz petlju --}}
                        @foreach ($attendances as $attendance)
                          <tr>
                            <th scope="row">{{ $attendance->id }}</th>
                            <td>{{ $attendance->subject->name }}</td>
                            <td>{{ $attendance->description }}</td>
                            <td>{{ $attendance->date }}</td>
                            <td>
                                {{-- BUTTONS --}}
                                <a href="{{ route('attendances.edit', $attendance->id) }}"><button type="button" class="btn btn-primary float-left" title="Uredi kolegij" style="margin-right: 5px;"><i class="far fa-edit"></i></button></a>
                                <a href="{{ route('attendances.editattendance', $attendance->id) }}"><button type="button" class="btn btn-primary float-left" title="Uredi dolaznost" style="margin-right: 5px;">Uredi dolaznost</button></a>
                                <form action="{{ route('attendances.destroy', $attendance) }}" method="POST" class="float-left">
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
