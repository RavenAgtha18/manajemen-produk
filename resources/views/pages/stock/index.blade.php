@extends('layouts.main')
{{-- @dd($stockMovements) --}}
@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Stock</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Stock</li>
      </ol>
    </div>
  </div>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-end">
            <a href="/stock/create" class="btn btn-primary btn-sm">Add Stock</a>
          </div>
            <div class="card-body p-0">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Change Type</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($stockMovements as $stockMovement)
                      <tr>
                          <td>{{ ($stockMovements->currentPage() - 1) * $stockMovements->perPage() + $loop->index + 1 }}</td>
                          <td>{{ $stockMovement->product->name }}</td>
                          <td>{{ $stockMovement->quantity }}</td> 
                          <td>{{ $stockMovement->change_type }}</td> 
                      </tr>
                  @endforeach
              </tbody>
          </table>
          <div class="card-footer">
              {{ $stockMovements->links('pagination::bootstrap-5') }} 
          </div>
          </div>
    </div>
</div>
@endsection
