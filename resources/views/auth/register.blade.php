@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="card">
        <div class="card-body register-card-body">
            <h3 class="login-box-msg">Register a new account</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                        required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>

            <p class="mt-3">
                <a href="{{ route('login') }}">I already have an account</a>
            </p>
        </div>
    </div>
@endsection
