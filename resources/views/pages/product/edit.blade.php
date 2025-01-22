@extends('layouts.main')
{{-- @if($errors->any())
  @dd($errors->all())
@endif --}}
@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Edit Product</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
         
            <div class="card-body p-0">
            <div class="card card-primary card-outline mb-4">
                  <div class="card-header"><div class="card-title">Edit Product</div></div>
                  <form action="/product/{{ $product->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id===$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $product->name) }}" 
                        />
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="description" class="form-label">Description</label>
                      <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                  </div>
                      <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input
                          type="number"
                           class="form-control @error('price') is-invalid @enderror"
                          id="price"
                          inputmode="numeric"
                          name="price"
                          value="{{ old('price', $product->price) }}" 
                        />
                        @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input
                          type="number"
                          class="form-control @error('stock') is-invalid @enderror"
                          id="stock"
                          inputmode="numeric"
                          name="stock"
                          value="{{ old('stock', $product->stock_quantity) }}" 
                        />
                        @error('stock')
                        <span class="invalid-feedback">{{ $message }}</span>
                       @enderror
                      </div>
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" name="image_file" id="image_file" />
                        <label class="input-group-text" for="image_file">Upload</label>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="d-flex justify-content-end">
                        <a href="/product" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
            </div>

          </div>
    </div>
</div>
@endsection
