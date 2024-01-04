@extends('base')

@section('content')
<div class="container">
    <h2>View botique Details</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Item Name:</strong> {{ $botique->item }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $botique->description }}</p>
            <p class="card-text"><strong>Brand:</strong> {{ $botique->brand }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $botique->quantity }}</p>
            <p class="card-text"><strong>Price:</strong> {{ $botique->price }}</p>
            <p><strong>Created on:</strong> {{ $botique->created_at->timezone('Asia/Manila')->format('F j, Y, g:i A') }}</p>

            <a href="{{ route('botiques.index') }}" class="btn btn-primary" style="background-color:palevioletred">Back to botique List</a>
        </div>
    </div>
</div>
@endsection
