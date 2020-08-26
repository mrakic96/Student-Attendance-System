@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Kolegiji
                <a href="{{ route('admin.subjects.create') }}"><button type="button" class="btn btn-primary btn float-right" title="Novi kolegij"><i class="fas fa-plus"></i></button></a>

                </div>

                <div class="card-body">
                    <table class="table table-bordered data-table">
                    <thead>
            <tr>
                <th>No</th>
                <th>Naziv</th>
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
        ajax: "{{ route('admin.subjects.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });    
  });
</script>
@endpush