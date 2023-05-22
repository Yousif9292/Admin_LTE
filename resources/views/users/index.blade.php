@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
@endsection
@extends('layouts.app');

@section('content')
    <div class="content-wrapper px-4 py-2">
        <button style="float: right; margin-bottom:10px; margin-top: 20px;border: none;padding: 0px;">
            <a class="btn btn-small btn-success" href="{{ route('users.create') }}">Create a user</a>
        </button>
        <h1 style="font-size: 30px;margin-top:20px">Users</h1>

        <!-- user table -->
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
    @push('scripts')
        <!-- Datatable -->
        {{--   --}}
        <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}

        <script type="text/javascript">
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            var table = $('#usertable').DataTable({
                dom: "Bfrtip",
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [ {data: 'DT_RowIndex', name: 'DT_RowIndex'},
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

            // $('body').on('click', '.edit', function () {
            // var id = $(this).data('id');
            //     $.get("{{ route('users.index') }}" +'/' + id +'/edit', function (data) {
            //         $('#modelHeading').html("Edit Post");
            //         $('#savedata').val("edit-user");
            //         $('#ajaxModelexa').modal('show');
            //         $('#id').val(data.id);
            //         $('#name').val(data.name);
            //         $('#email').val(data.email);
            //     })
            // });
        </script>
    @endpush
@endsection
