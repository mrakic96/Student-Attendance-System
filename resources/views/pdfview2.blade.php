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
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }
    </style>

    <title>PDF Generator</title>
</head>
<body>
<div class="container">
    <h2 style="text-align: center; ">Postotak dolaznosti na predavanja za pojedini kolegij</h2>
    <br>
    <h4>Student: {{ $user->name }}</h4>
    <h4>Email: {{ $user->email }}</h4>
    <br>
    <br>
    @if ($user->hasRole('student'))
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

                                    {{ number_format(($user->attendances()
                                    ->where('attendance', 'da')
                                    ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                    ->get()
                                    ->count()/$totalHeldNum) * 100, 2, '.','') }} %
                                    &nbsp;&nbsp;&nbsp;&nbsp; ( {{ ($user->attendances()
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
    <br>
    <br>
    <br>
    <br>
    <p style="text-align: right;"><small>Statistiku izdao: {{ Auth::user()->name }}</small></p>
    <p style="text-align: right;"><small>Datum: {{ date('d.m.Y.') }} u {{ date('H:i') }} h</small></p>
    <hr style="margin-right: 0px; width: 150px;">
    <p style="text-align: right; margin-right: 27px;">FSRE Mostar</p>
</div>
</body>
</html>

