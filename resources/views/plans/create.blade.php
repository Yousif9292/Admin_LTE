@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="h4">Create New Plans</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <button style="float: right; margin-bottom:20px; margin-top: 0px;border: none;padding: 0px;">
                        <a class="btn btn-primary" href="{{ route('plans.view') }}"> Back</a>
                    </button>
                @endcan

            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Please fix the following errors:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('plans.store') }}" method="POST">
        @csrf
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="stripe_plan">Stripe Plan</label>
            <input type="text" name="stripe_plan" id="stripe_plan" class="form-control" value="{{ old('stripe_plan') }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="duration">Duration</label>
            <input type="text" name="duration" id="duration" class="form-control" value="{{ old('duration') }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <br />
        <button type="submit" style="background-color: blue; margin-top: 20px; margin-left:485px " class="btn btn-primary">Create
            Plan</button>
        </div>
    </form>
@endsection





