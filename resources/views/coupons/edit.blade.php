@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 class="h4">Update Coupon</h1>
            </div>
            <div class="pull-right">
                @can('role-create')
                    <button style="float: right; margin-bottom:10px; margin-top: -20px;border: none;padding: 0px;">
                        <a class="btn btn-primary" href="{{ route('coupons.index') }}"> Back</a>
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

    <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Code:</strong>
                    <input type="text" name="code" id="code" class="form-control" value="{{ $coupon->code }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start Date::</strong>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ $coupon->start_date->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Expiry Date:</strong>
                    <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                        value="{{ $coupon->expiry_date->format('Y-m-d') }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Discount Amount:</strong>
                    <input type="number" name="discount_price" id="discount_price" class="form-control"
                        value="{{ $coupon->discount_price }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" value="{{ $coupon->status }}" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" style="background-color: blue; margin-left:485px "
                    class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection
