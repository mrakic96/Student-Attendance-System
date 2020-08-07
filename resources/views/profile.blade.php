@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ Auth::user()->name }} - Informacije

                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Ime</th>
                                <th scope="col">Email</th>
                                @if(Auth::user()->hasRole('student'))
                                <th scope="col">Indeks</th>
                                @endif
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ Auth::user()->email }}</td>
                                @if(Auth::user()->hasRole('student'))
                                <td scope="col">{{ Auth::user()->index }}</td>
                                @endif
                                <td>{{ implode(', ', Auth::user()->roles()->get()->pluck('name')->toArray()) }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                @if (Auth::user()->hasRole('student'))
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
                                            Kolegij nije imao predavanja.
                                        @else

                                            {{ number_format((Auth::user()->attendances()
                                            ->where('attendance', 'da')
                                            ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                            ->get()
                                            ->count()/$totalHeldNum) * 100, 2, '.','') }} %
                                          | ( {{ (Auth::user()->attendances()
                                            ->where('attendance', 'da')
                                            ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                            ->get()
                                            ->count()/$totalHeldNum) }} / {{ $totalHeldNum }} )
                                        @endif
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                        <a href="{{ route('pdfdownload') }}"><button class="btn btn-primary float-right">PDF Ispis</button></a>

                    </div>

                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
