@extends('base')

@section('content')
<div class="container">
    <h2>Dress List</h2>

    <a href="{{ route('botiques.create') }}" class="btn float-end mb-lg-2" style="background-color:#ac4e10" >Add New Dress</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($botiques as $botique)
                <tr>
                    <td>{{ $botique->item}}</td>
                    <td>{{ $botique->description }}</td>
                    <td>{{ $botique->brand }}</td>
                    <td>{{ $botique->quantity }}</td>
                    <td>{{ $botique->price }}</td>
                    <td>
                        <a href="{{ route('botiques.show', $botique->id) }}" class="btn btn-info btn-sm" style="background-color:rgb(233, 174, 97)">View</a>
                        <a href="{{ route('botiques.edit', $botique->id) }}" class="btn btn-primary btn-sm" style="background-color:rgb(112, 114, 216)">Edit</a>
                        <form action="{{ route('botiques.destroy', $botique->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"  style="background-color:rgb(236, 27, 27)" onclick="return confirm('Are you sure you want to delete this botique?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
