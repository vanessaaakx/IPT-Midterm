@extends('base')

@section('content')
<div class="container col-md-3 offset-md-3 mt-5" style="background-color:palevioletred">
    <h2>Create a New Dress</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('botiques.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="item">Item</label>
            <input type="text" class="form-control" id="item" name="item" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" required>
        </div>
        <div class="form-group mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group mb-3">
            <label for="price">Price</label>
            <input type="double" class="form-control" id="price" name="price" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3" style="background-color:rgb(128, 112, 216)"">Create botique</button>
    </form>
</div>
@endsection
