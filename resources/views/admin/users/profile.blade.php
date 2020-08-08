@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ $user->name }} - Informacije

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
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                @if ($user->hasRole('student'))
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

                                                {{ number_format(($user->attendances()
                                                ->where('attendance', 'da')
                                                ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                                ->get()
                                                ->count()/$totalHeldNum) * 100, 2, '.','') }} %
                                                | ( {{ $user->attendances()
                                            ->where('attendance', 'da')
                                            ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                            ->get()
                                            ->count() }} / {{ $totalHeldNum }} )
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                            <a href="{{ route('pdfdownload2', $user->id) }}"><button class="btn btn-primary float-right">PDF Ispis</button></a>

                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
