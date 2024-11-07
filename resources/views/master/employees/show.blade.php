@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Details</h1>
        <div>
            <strong>Name:</strong> {{ $employee->name }}
        </div>
        <div>
            <strong>Email:</strong> {{ $employee->email }}
        </div>
        <div>
            <strong>Contact Number:</strong> {{ $employee->contact_number }}
        </div>
        <div>
            <strong>Position:</strong> {{ $employee->position }}
        </div>
        <div>
            <strong>Role:</strong> {{ ucfirst($employee->role) }}
        </div>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
@endsection
