@extends('layouts.main')

@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Product Details</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/product">Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product Details</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Product Information</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" value="{{ $product->category->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" class="form-control" value="{{ $product->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" readonly>{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" value="Rp. {{ number_format($product->price, 0, ',', '.') }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="text" class="form-control" value="{{ $product->stock_quantity }}" readonly>
                            </div>
                            @if($product->image)
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <img 
                                    src="{{ asset('storage/' . $product->image) }}" 
                                    class="img-fluid rounded" 
                                    alt="Product Image"
                                    style="max-height: 300px; object-fit: cover;"
                                >
                            </div>
                            @else
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <p class="text-muted">No image available</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="/product" class="btn btn-outline-secondary">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection