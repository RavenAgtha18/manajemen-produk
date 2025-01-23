@extends('layouts.main')
{{-- @dd($products) --}}
@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Category</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-end">
            <a href="/category/create" class="btn btn-primary btn-sm">Add Category</a>
          </div>
            <div class="card-body p-0">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Category Name</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                          <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                             <div class="d-flex">
                              <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                              <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
              {{ $categories->links('pagination::bootstrap-5') }}
            </div>
          </div>
    </div>
</div>
@endsection
