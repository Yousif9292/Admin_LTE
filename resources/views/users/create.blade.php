@extends('layouts.app')
@section('title')
    Create New User
@endsection
@section('content')
    <form method="post" action="{{ route('users.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label><br /><br />
            <input type="text" class="form-control" name="name" />
        </div>

        <div class="form-group">
            <label for="email">Email:</label><br /><br />
            <input type="email" class="form-control" name="email" id="email" />
        </div>

        <div class="form-group">
            <label for="Password">Password:</label><br /><br />
            <input type="password" class="form-control" name="password" id="password" />
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles[]" class="form-control">
                    @foreach($roles as $roleId => $roleName)
                        <option value="{{ $roleId }}">{{ $roleName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <br />
        <button type="submit" style="background-color: blue; margin-left:485px " class="btn btn-primary">Register</button>
    </form>
@endsection
