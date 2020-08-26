@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">{{ $subject->name }} - Informacije

                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Naziv</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>{{ $subject->name }}</td>
                            </tbody>
                            
                        </table>
                        @if(Auth::user()->hasRole('admin')) 
                            <td>
                                <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="float-right">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Jeste li sigurni?')" title="Izbriši kolegij"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                            @endif
                    </div>
                </div>

                        </div>

                    </div>
                
            </div>
@endsection