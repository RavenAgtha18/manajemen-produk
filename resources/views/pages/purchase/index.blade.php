@extends('layouts.main')

@section('header')
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Purchases</h3></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Purchases</li>
      </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-end">
            <a href="/purchase/create" class="btn btn-primary btn-sm">Add Purchase</a>
          </div>
          <div class="card-body p-0">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($purchases as $purchase)
                      <tr>
                          <td>{{ ($purchases->currentPage() - 1) * $purchases->perPage() + $loop->index + 1 }}</td>
                          <td>{{ $purchase->product->name }}</td>
                          <td>{{ $purchase->quantity }}</td> 
                          <td>{{ number_format($purchase->total_price, 2) }}</td> 
                      </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="card-footer">
                  {{ $purchases->links('pagination::bootstrap-5') }} 
              </div>
          </div>
        </div>
    </div>
</div>
@endsection