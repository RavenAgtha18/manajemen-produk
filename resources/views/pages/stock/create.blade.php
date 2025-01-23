@extends('layouts.main')
{{-- @if($errors->any())
  @dd($errors->all())
@endif --}}
@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Add Stock</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item active" aria-current="page">Add Stock</li>
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
                  <div class="card-header"><div class="card-title">Add Stock</div></div>
                  <form action="/stock/store" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Products</label>
                            <select name="product_id" id="product_id" class="form-control" required>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input
                                type="number"
                                class="form-control @error('quantity') is-invalid @enderror"
                                id="quantity"
                                inputmode="numeric"
                                name="quantity"
                                value="{{ old('quantity') }}" 
                                required
                            />
                            @error('quantity')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="change_type" class="form-label">Change Type</label>
                            <select name="change_type" id="change_type" class="form-control @error('change_type') is-invalid @enderror" required>
                                <option value="">Select Change Type</option>
                                <option value="increase">Increase</option>
                                <option value="decrease">Decrease</option>
                            </select>
                            @error('change_type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <a href="/stock" class="btn btn-outline-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>   
                    </div>
                </form>
                </div>
            </div>

          </div>
    </div>
</div>
@endsection
