@extends('layouts.auth')
@section('content')
    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-floating mb-3">
                <input class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"  />
                <label for="inputFirstName">Full name</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <label for="inputEmail">Email address</label>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Create a password" />
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input class="form-control" 
                        id="password_confirmation"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <label for="inputPasswordConfirm">Confirm Password</label>
                    </div>
                </div>
            </div>
            <div class="mt-4 mb-0">
               
                <div class="d-grid">
                    <button class="btn btn-primary btn-block" type="submit"> Create Account</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-center py-3">
        <div class="small">
            <a href="{{ route('login') }}">Have an account? Go to login</a>
            
        </div>
    </div>
@endsection
