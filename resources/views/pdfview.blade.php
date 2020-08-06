<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>

    <title>PDF Generator</title>
</head>
<body>
    <h2 style="text-align: center; ">Postotak dolaznosti na predavanja za pojedini kolegij</h2>
    <br>
    <h4>Student: {{ Auth::user()->name }}</h4>
    <h4>Email: {{ Auth::user()->email }}</h4>
    <br>
    <br>
    @if (Auth::user()->hasRole('student'))
        <div class="card">
            <div class="card-body">

                <table class="table" style="width: 100%">
                    <thead>
                    <tr>
                        <th scope="col">Kolegij</th>
                        <th scope="col">Dolaznost*</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(array_combine($subjects, $totalHeldNums) as $subject => $totalHeldNum)
                        <tr>
                            <td style="text-align: center;">{{ $subject }}</td>
                            <td style="text-align: center;">
                                @if($totalHeldNum == 0)
                                    Kolegij nije imao predavanja.
                                @else

                                    {{ number_format((Auth::user()->attendances()
                                    ->where('attendance', 'da')
                                    ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                    ->get()
                                    ->count()/$totalHeldNum) * 100, 2, '.','') }} %
                                    &nbsp;&nbsp;&nbsp;&nbsp; ( {{ (Auth::user()->attendances()
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
            </div>
        </div>
    @endif
    <p><small>*(Ukupna dolaznost studenta / (podijeljeno sa) ukupan broj predavanja) * (puta) 100</small></p>
    <br>
    <hr style="float: right; margin-right: 0px; width: 120px;">
    <p style="float: right;">FSRE Mostar</p>
</body>
</html>

