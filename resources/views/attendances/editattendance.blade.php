@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Predavanje iz kolegija {{ $attendance->id }} {{ $attendance->subject->name }} na datum {{ $attendance->date }}
                </div>

                <div class="card-body">
                  <form action="{{ route('attendances.updateattendance', $attendance->id) }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Student</th>
                            <th scope="col">Prisutnost</th>
                            <th scope="col">Potvrdi</th>
                          </tr>
                        </thead>
                        <tbody>
                        {{-- Iteriramo sva predavanja kroz petlju --}}
                        @foreach ($users as $user)
                            @if($user->hasSubject($attendance->subject->name))
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{-- <label for="attendance" class="col-md-2 col-form-label text-md-right">prisutan</label> --}}

                                        <div class="col-md-6">
                                            {{-- <input type="hidden" name="user-id" value="{{ $user->id }}"/> --}}
{{--                                            <input id="attendance[]" type="text" class="form-control" name="attendance[{{ $user->id }}]" required>--}}
                                            <select name="attendance[{{ $user->id }}]" id="attendance[]">
                                                <option value="ne">ne</option>
                                                <option value="da">da</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>

                            @endif
                        @endforeach

                        {{-- Kraj petlje --}}
                        </tbody>
                      </table>
                      <button type="submit" class="btn btn-primary float-right">Spremi</button>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


