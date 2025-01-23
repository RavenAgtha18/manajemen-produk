@extends('layouts.main')

@section('header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Add Purchase</h3>
    </div>
</div>
@endsection

@section('content')
<div class="row p-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('purchase.calculate') }}" method="POST">
                    @csrf
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="product_id">Product Name</label>
                        </div>
                        <div class="col-md-8">
                            <select name="product_id" id="product_id" class="form-select" required>
                                <option value="">-- Select Product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="quantity">Quantity</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="quantity" id="quantity" min="1" required value="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">Calculate Total Price</button>
                            <a href="{{ route('purchase') }}" class="btn btn-secondary">Back to Purchases</a>
                        </div>
                    </div>
                </form>

                <div class="row mt-3">
                  <div class="col-md-4"></div>
                  <div class="col-md-8">
                      <h5>Total Price: <span id="totalPrice">Rp. {{ session('total_price') ? number_format(session('total_price'), 2, ',', '.') : '0,00' }}</span></h5>
                      @if (session('total_price'))
                          <form action="{{ route('purchase.store') }}" method="POST">
                              @csrf
                              <input type="hidden" name="product_id" value="{{ session('product_id') }}">
                              <input type="hidden" name="quantity" value="{{ session('quantity') }}">
                              <input type="hidden" name="total_price" value="{{ session('total_price') }}">
                              <button type="submit" class="btn btn-success">Confirm Purchase</button>
                          </form>
                      @endif
                  </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection