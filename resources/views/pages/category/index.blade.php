@extends('layouts.main')

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
                            <th>Action</th>
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
                                      <button class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#showCategoryModal" 
                                          data-name="{{ $category->name }}">
                                          Show
                                      </button>
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

<!-- Modal -->
<div class="modal fade" id="showCategoryModal" tabindex="-1" aria-labelledby="showCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="showCategoryModalLabel">Category Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p><strong>Category Name:</strong> <span id="categoryName"></span></p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Event listener untuk modal
  var showCategoryModal = document.getElementById('showCategoryModal');
  showCategoryModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; 
      var name = button.getAttribute('data-name'); 

      var categoryName = showCategoryModal.querySelector('#categoryName');
      categoryName.textContent = name; 
  });
</script>
@endsection