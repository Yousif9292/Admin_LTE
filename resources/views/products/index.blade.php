@extends('layouts.app')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Buttons -->
    <link href="https://nightly.datatables.net/buttons/css/buttons.dataTables.css?_=c6b24f8a56e04fcee6105a02f4027462.css"
        rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categories Management</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <button style="float: right; margin-bottom:10px; margin-top: 20px;border: none;padding: 0px;">
                        <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Catagory</a>
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
            <h3 class="card-title">Product Data</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="ptable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Discount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td> <img src="{{ asset('/' . $product->image) }}" alt="Product Image" width="50"></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->purchase_price }}</td>
                            <td>{{ $product->sale_price }}</td>
                            <td>{{ $product->discount }}</td>
                            <td>{{ $product->status }}</td>
                            <td>

                                <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                                @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                                @endcan

                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                    id="deleteForm{{ $product->id }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" style="background-color:#cf1010"
                                        onclick="deleteCategoryConfirmation({{ $product->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
        {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script> --}}


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

        {{-- sweet Alert --}}
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.all.min.js') }}"></script>

        <script>
            // datatable
            $(document).ready(function() {
                var table = $('#ptable').DataTable({
                    dom: "Bfrtip ",
                    buttons: ["copy", "pdf", "print", ],

                });
            });
            // sweet Alert

            function deleteCategoryConfirmation(categoryId, hasParent, hasChildren) {
                if (hasChildren) {
                    Swal.fire({
                        title: 'Delete Child Category',
                        text: 'This category is a child category. Are you sure you want to delete it?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('deleteForm' + categoryId).submit();
                        }
                    });
                } else {
                    if (hasParent) {
                        Swal.fire({
                            title: 'Delete Parent Category',
                            text: 'This category has child categories. Are you sure you want to delete it?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('deleteForm' + categoryId).submit();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Parent Category',
                            text: 'Are you sure you want to delete this parent category?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Parent Category Deleted',
                                    text: 'The parent category has been deleted.',
                                    icon: 'success'
                                }).then(() => {
                                    document.getElementById('deleteForm' + categoryId).submit();
                                });
                            }
                        });
                    }
                }
            }
        </script>
    @endpush
@endsection




{{-- <div class="card-body">
    <table class="table table-bordered" id="ptable">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>Discount</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td> <img src="{{ asset('/' . $product->image) }}" alt="Product Image" width="50"></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->purchase_price }}</td>
                    <td>{{ $product->sale_price }}</td>
                    <td>{{ $product->discount }}</td>
                    <td>{{ $product->status }}</td>
                    <td>

                        <a class="btn btn-info" href="{{ route('products.show', $product->id) }}">Show</a>
                        @can('product-edit')
                            <a class="btn btn-primary" href="{{ route('products.edit', $product->id) }}">Edit</a>
                        @endcan

                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                            id="deleteForm{{ $product->id }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" style="background-color:#cf1010"
                                onclick="deleteCategoryConfirmation({{ $product->id }})">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
