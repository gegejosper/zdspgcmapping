@extends('layouts.layout')
@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pt-4">
            <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary mb-3">
                <div class="card-header">
                    <h3 class="card-title">Profile Information</h3>
                </div>

                @include('profile.partials.update-profile-information-form')
                
                </div>
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Password</h3>
                </div>
                @include('profile.partials.update-password-form')
                <!-- /.card -->
            </div>
            
            </div>
        </div>
    </main>
@endsection
