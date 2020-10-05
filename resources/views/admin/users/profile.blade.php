@extends('layouts.admin')

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
                        @if(Auth::user()->hasRole('admin')) 
                            <td>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-right">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Jeste li sigurni?')" title="Izbriši korisnika"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                            @endif
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
                    <br>
                    <div class="card">
                        <div class="card-header"> <b>Izostanci</b>

                        </div>
                        <div class="card-body">

                            <table class="table">
                                
                                <tbody>
                                @foreach(array_combine($subjects, $totalHeldNums) as $subject => $totalHeldNum)
                                    
                                @if ($totalHeldNum == 0 )

                                @elseif ($user->attendances()
                                ->where('attendance', 'da')
                                ->where('subject_id', \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                ->get()
                                ->count()/$totalHeldNum == 1)
                                
                                @else
                                    <div class="card float-sm-left" style="width: 18rem; margin-right:15px;">
                                        <div class="card-body">
                                          <h5 class="card-title">{{ $subject }}</h5>
                                            <br>
                                            <br>
                                          <p class="card-text">

                                    
                                                @foreach ($attendances as $attendance)
                                                    @if($attendance->subject_id == \App\Subject::where('name', $subject)->get()->pluck('id')->first())
                                                        @if($user->attendances()
                                                            ->where('attendance_id', $attendance->id)->where('attendance', 'ne')->get()->first())
                                                        {{ $attendance->date  }}
                                                        <br>
                                                        @endif
                                                    @endif
            
                                                @endforeach

                                          </p>
                                                                                  
                                        </div>
                                      </div>
                                @endif

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
