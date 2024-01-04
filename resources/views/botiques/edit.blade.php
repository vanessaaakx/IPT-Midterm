@extends('base')

@section('content')
<div class="container col-md-3 offset-md-3 mt-5" style="background-color:palevioletred">
    <h2>Edit Botique</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('botiques.update', $botique->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use PUT method for updating -->
        <div class="form-group">
            <label for="item">Item</label>
            <input type="text" class="form-control" id="item" name="item" value="{{ $botique->item }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $botique->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" value="{{ $botique->brand }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $botique->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="double" class="form-control" id="price" name="price" value="{{ $botique->price }}" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3" style="background-color:rgb(128, 112, 216)">Update botique</button>
    </form>
</div>
@endsection
