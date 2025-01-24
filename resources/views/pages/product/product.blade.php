@extends('layouts.main')
{{-- @dd($products) --}}
@section('header')
<div class="row">
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="col-sm-6"><h3 class="mb-0">Product</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')
<div class="row">
  <div class="col">
      <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Product Management</h5>
              <div>
                  <a href="/product-export" class="btn btn-success btn-sm me-2">Export Product</a>
                  <a href="#" class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#importModal">Import Product</a>
                  {{-- <a href="#" class="btn btn-secondary btn-sm">Template Product</a> --}}
                  <a href="/product/create" class="btn btn-primary btn-sm me-2">Add Product</a>
              </div>
          </div>
          <div class="card-body p-0">
              <table class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th style="width: 10px">No</th>
                          <th>Category</th>
                          <th>Product Name</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Stock</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($products as $product)
                          <tr>
                              <td>{{ ($products->currentPage() - 1) * $products->perPage() + $loop->index + 1 }}</td>
                              <td>{{ $product->category->name }}</td>
                              <td>{{ $product->name }}</td>
                              <td>{{ $product->description }}</td>
                              <td>{{ $product->price }}</td>
                              <td>{{ $product->stock_quantity }}</td>
                              <td>
                                  <div class="d-flex">
                                      <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                                      <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm me-2">Show</a>
                                      <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                      </form>
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
          <div class="card-footer">
              {{ $products->links('pagination::bootstrap-5') }}
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="importModalLabel">Import Products</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{ route('product.import') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                      <label for="file" class="form-label">Upload Excel File</label>
                      <input type="file" class="form-control" id="file" name="file" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Import</button>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection
