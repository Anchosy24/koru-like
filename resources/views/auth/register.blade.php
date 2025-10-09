@extends('layouts.landing')

@section('content')
<a href="{{ route('login') }}" class="d-block text-start link-light fw-bold mb-4">Back to sign in</a>
<h2 class="fw-bold mb-3">Create Your Account</h2>
<form method="POST" action="{{ route('register.post') }}">
@csrf
<!-- Name -->
<div class="mb-3">
    <label for="name" class="form-labe fw-bold">Name</label>
    <div class="input-group">
        <span class="input-group-text bg-white" id="">
            <i class="bi bi-person"></i>
        </span>
    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" value="{{old('name')}}" required>
    </div>
</div>
<!-- Email -->
@error('email')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="mb-3">
    <label for="email" class="form-labe fw-bold">Email</label>
    <div class="input-group">
        <span class="input-group-text bg-white" id="">
            <i class="bi bi-envelope"></i>
         </span>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" value="{{old('email')}}" required>
    </div>
</div>
<!-- Password -->
@error('password')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="mb-3 position-relative">
    <label for="password" class="form-label fw-bold">Password*</label>
    <div class="input-group">
        <span class="input-group-text bg-white" id="">
            <i class="bi bi-lock-fill"></i>
        </span>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required>
    </div>
</div>
<!-- Re-Password -->
@error('re-password')
    <small class="text-danger">{{ $message }}</small>
@enderror
<div class="mb-3 position-relative">
    <label for="re-password" class="form-label fw-bold">Confirm Password*</label>
    <div class="input-group">
        <span class="input-group-text bg-white" id="">
            <i class="bi bi-lock-fill"></i>
        </span>
        <input type="password" class="form-control" name="re-password" id="re-password" placeholder="Re-enter your password" required>
    </div>
</div>
<input type="hidden" name="type" id="type" value="register">
<!-- Login Button -->
<div class="d-grid">
    <button type="submit" class="btn btn-dark text-white border border-white mt-3 mb-1">Register</button>
</div>
</form>
@endsection
