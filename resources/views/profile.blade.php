@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ \Illuminate\Support\Facades\Auth::user()->name }} - Informacije

                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Ime</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td>{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                                <td>{{ \Illuminate\Support\Facades\Auth::user()->email }}</td>
                                <td>{{ implode(', ', \Illuminate\Support\Facades\Auth::user()->roles()->get()->pluck('name')->toArray()) }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
        <br>
                @if (\Illuminate\Support\Facades\Auth::user()->hasRole('student'))
                <div class="card">
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Kolegij</th>
                                <th scope="col">Dolaznost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(array_combine($subjects, $totalHeldNums) as $subject => $totalHeldNum)
                                <tr>
                                    <td>{{ $subject }}</td>
                                    <td>
                                        @if($totalHeldNum == 0)
                                            0 %
                                        @else

                                            {{ (Auth::user()->attendances()
                                            ->where('attendance', 'da')
                                            ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                            ->get()
                                            ->count()/$totalHeldNum) * 100 }} %
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
