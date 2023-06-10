@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="h4">Update Product</h2>
            </div>
            <div class="pull-right">
                @can('role-create')
                <button style="float: right; margin-bottom:10px; margin-top: -20px;border: none;padding: 0px;">
                    <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <img src="{{ asset('/' . $product->image) }}" alt="Product Image" width="50">
                    <input type="file" name="image" class="form-control-file">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" placeholder="Product Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Purchase Price:</strong>
                    <input type="text" name="purchase_price" value="{{$product->purchase_price}}"class="form-control" placeholder="Purchase Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Sale Price:</strong>
                    <input type="text" name="sale_price" value="{{$product->sale_price}}"class="form-control" placeholder="Sale Price">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Discount:</strong>
                    <input type="number" name="discount" value="{{$product->discount}}"  class="form-control" placeholder="Discount">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" value="{{$product->status}}" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id"  class="form-control">
                        <option value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" style="background-color: blue; margin-left:485px " class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection
