@extends('layouts.auth')
@section('content')
<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
    @csrf
        <div class="form-floating mb-3">
            <input class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <label for="inputEmail">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Password" />
            <label for="inputPassword">Password</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="/forgot-password">Forgot Password?</a>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
</div>
<div class="card-footer text-center py-3">
    <div class="small"><a href="/register">Need an account? Sign up!</a></div>
</div>
@endsection

