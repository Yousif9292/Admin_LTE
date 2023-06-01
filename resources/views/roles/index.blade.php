@extends('layouts.app')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap4.min.css"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    ndsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Role Management</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <button style="float: right; margin-bottom:10px; margin-top: 20px;border: none;padding: 0px;">
                        <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
                    </button>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Roles Data</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="t1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                                @can('role-edit')
                                    <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                @endcan
                                @can('role-delete')
                                    @if ($role->deleteable == 1)
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['roles.destroy', $role->id],
                                            'style' => 'display:inline',
                                            'id' => "delete-form-{$role->id}",
                                        ]) !!}
                                        {!! Form::submit('Delete', [
                                            'class' => 'btn btn-danger',
                                            'style' => 'color:black;',
                                            'onclick' => "event.preventDefault(); showDeleteConfirmation('{$role->id}');",
                                        ]) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! $roles->render() !!}
    @push('scripts')
    {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script> --}}


        {{-- sweet Alert --}}
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js') }}"></script>
        <!-- DataTables  & Plugins -->
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script>
            // datatable
            $(document).ready(function() {
                var table = $('#t1').DataTable({
                    dom: "Bfrtip ",
                    buttons: ["copy", "pdf", "print", ],

                });
            });
            // sweet Alert
            function showDeleteConfirmation(roleId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#delete-form-${roleId}`).submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    };
                });
                // Proceed with the form submission
            };
        </script>
    @endpush
@endsection
