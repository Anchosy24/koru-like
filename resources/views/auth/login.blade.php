@extends('layouts.landing')

@section('content')
<img src="{{ asset('image/koru-nobg.png') }}" alt="" class="rounded-circle me-2 mb-3" width= 100; height = 100;>
<h2 class="fw-bold mb-3">Welcome to Koru</h2>
<p class="fw-bold opacity-75 mb-3">Sign in to Continue</p>
<div class="d-grid">
    <a href="/auth-google-redirect" class="btn btn-dark text-white border border-white"><i class="fab fa-google me-2"></i> Sign in with google</a>
</div>
<div class="divider d-flex align-items-center my-4">
    <p class="text-center fw-bold mx-3 mb-0">Or</p>
</div>
<form method="POST" action="{{ route('login.post') }}">
@csrf
<!-- Email -->
<div class="mb-3">
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <label for="email" class="form-labe fw-bold">Email*</label>
    <div class="input-group">
        <span class="input-group-text bg-white" id="">
            <i class="bi bi-envelope"></i>
        </span>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="{{old('email')}}" required>
    </div>
</div>
<!-- Password -->
<div class="mb-3 position-relative">
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <label for="password" class="form-label fw-bold">Password*</label>
    <div class="input-group">
        <span class="input-group-text bg-white" id="">
            <i class="bi bi-lock-fill"></i>
        </span>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
    </div>
</div>
<!-- Login Button -->
<div class="d-grid">
    <button type="submit" class="btn btn-dark text-white border border-white mt-3 mb-1">Login</button>
</div>
<div class="d-flex justify-content-between align-items-center">
    <p class="small mt-2 pt-1 mb-0">Need an account? <a href="{{ route('register') }}" class="link-light fw-bold">Sign Up</a></p>
</div>
</form>
@endsection