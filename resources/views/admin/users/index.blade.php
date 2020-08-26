@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Korisnici
                <a href="{{ route('admin.users.create') }}"><button type="button" class="btn btn-primary btn float-right" title="Novi korisnik"><i class="fas fa-user-plus"></i></button></a>

                </div>
                <ul class="nav nav-tabs">
                  @can('manage-users')
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.administratori') }}">Administratori</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.profesori') }}">Profesori</a>
                      </li>
                  @endcan
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Studenti</a>
                  </li>
                </ul>
                <div class="card-body">
                    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Ime</th>
                <th>Email</th>
                <th>Index</th>
                <th width="20%">Akcija</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">

  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'index', name: 'index'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });    
  });
</script>
@endpush