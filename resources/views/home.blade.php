@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sustav za nadzor dolaznosti studenata</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif  

                    Dobrodošli, {{ Auth::user()->name }}! <br>
                    @if(Auth::user()->hasAnyRoles(['admin', 'profesor']))
                        
                    @endif  
                    
                    @if(Auth::user()->hasRole('student'))
                        Ispis Vaše dolaznosti na predavanja možete preuzeti na <a href="{{ route("profile") }}">profilu</a>
                    @endif  
                    
                </div>
            </div>
        </div>
    </div>
@endsection
