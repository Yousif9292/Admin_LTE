@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Create New Role</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <h3>Users Permissions</h3>
                        </li>
                        <li class="list-group-item">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input select-all" data-list="user_permissions">
                                <b>Select All</b>
                            </label>
                        </li>
                        @foreach ($usersPermissions as $permission)
                            <li class="list-group-item">
                                <label class="form-check-label">
                                    {!! Form::checkbox('permission[]', $permission->id, null, ['class' => 'form-check-input']) !!}
                                    {{ $permission->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <h3>Roles Permissions</h3>
                        </li>
                        <li class="list-group-item">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input select-all" data-list="role_permissions">
                                <b>Select All</b>
                            </label>
                        </li>
                        @foreach ($rolesPermissions as $permission)
                            <li class="list-group-item">
                                <label class="form-check-label">
                                    {!! Form::checkbox('permission[]', $permission->id, null, ['class' => 'form-check-input']) !!}
                                    {{ $permission->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <h3>Products Permissions</h3>
                        </li>
                        <li class="list-group-item">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input select-all" data-list="product_permissions">
                                <b>Select All</b>
                            </label>
                        </li>
                        @foreach ($productsPermissions as $permission)
                            <li class="list-group-item">
                                <label class="form-check-label">
                                    {!! Form::checkbox('permission[]', $permission->id, null, ['class' => 'form-check-input']) !!}
                                    {{ $permission->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" style="background-color: #007bff;" class="btn btn-primary">Submit</button>
        </div>
    </div>
    {!! Form::close() !!}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select-all').click(function() {
                var list = $(this).data('list');
                $('input[name="' + list + '[]"]').prop('checked', this.checked);
            });

            $('input[name="user_permissions[]"], input[name="role_permissions[]"], input[name="product_permissions[]"]')
                .click(function() {
                    var list = $(this).closest('ul').find('.select-all').data('list');
                    if ($('input[name="' + list + '[]"]:checked').length === $('input[name="' + list + '[]"]').length) {
                        $('input[data-list="' + list + '"]').prop('checked', true);
                    } else {
                        $('input[data-list="' + list + '"]').prop('checked', false);
                    }
                });
        });
    </script>
@endsection



























{{-- @extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif


{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($productsPermissions as $permission)
                <label>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'name')) }}
                {{ $permission->name }}</label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}
@endsection --}}
