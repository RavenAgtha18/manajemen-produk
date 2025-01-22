@extends('layouts.main')
{{-- @if($errors->any())
  @dd($errors->all())
@endif --}}
@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Edit Category</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item active" aria-current="page">Edit category</li>
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
                  <div class="card-header"><div class="card-title">Edit category</div></div>
                  <form action="/category/{{ $categories->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                   
                      <div class="mb-3">
                        <label for="category" class="form-label">Category Name</label>
                        <input
                            type="text"
                            class="form-control @error('category') is-invalid @enderror"
                            id="category"
                            name="category"
                            value="{{ old('category', $categories->name) }}" 
                        />
                        @error('category')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="card-footer">
                      <div class="d-flex justify-content-end">
                        <a href="/category" class="btn btn-outline-secondary me-2">Cancel</a>
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
