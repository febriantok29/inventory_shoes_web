@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Supplier Details</h1>
        <div>
            <strong>Name:</strong> {{ $supplier->name }}
        </div>
        <div>
            <strong>Contact Number:</strong> {{ $supplier->contact_number }}
        </div>
        <div>
            <strong>Email:</strong> {{ $supplier->email }}
        </div>
        <div>
            <strong>Address:</strong> {{ $supplier->address }}
        </div>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
