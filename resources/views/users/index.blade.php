@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- Buttons -->
    <link href="https://nightly.datatables.net/buttons/css/buttons.dataTables.css?_=c6b24f8a56e04fcee6105a02f4027462.css"
        rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
@endsection
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="h4">Users Management</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <button style="float: right; margin-bottom:10px; margin-top: 20px;border: none;padding: 0px;">
                        <a class="btn btn-small btn-success" href="{{ route('users.create') }}">Create a user</a>
                    </button>
                @endcan
            </div>
        </div>
    </div>




    <!-- user table -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Data</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped table-bordered" id="usertable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    @push('scripts')
        <script src="{{ asset('plugins/jquery/jquery.min.js"></script') }}">
            < script src = "{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" >
        </script>
        //
        <!-- DataTables  & Plugins -->
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
        // {{-- sweet Alert --}}
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js') }}"></script>

        <script>
            $(document).ready(function() {
                var table = $('#usertable').DataTable({
                    dom: "Bfrtip ",
                    serverSide: true,
                    ajax: "{{ route('users.index') }}",
                    buttons: ["copy", "pdf", "print", ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]

                });

                function deleteUser(event, userId) {
                    event.preventDefault(); // Prevent the default form submission

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this user!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send the AJAX request to delete the user
                            $.ajax({
                                url: '/users/' + userId,
                                type: 'POST',
                                data: {
                                    '_method': 'DELETE',
                                    '_token': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    // Reload or update the DataTable after successful deletion
                                    $('#usertable').DataTable().ajax.reload();
                                    Swal.fire(
                                        'Deleted!',
                                        'The user has been deleted.',
                                        'success'
                                    );
                                },
                                error: function(xhr) {
                                    Swal.fire(
                                        'Error!',
                                        'An error occurred while deleting the user.',
                                        'error'
                                    );
                                }
                            });
                        }
                    });
                };
            });
        </script>
    @endpush
@endsection
