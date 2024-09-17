@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Campus</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Fill Details</li>   
            </ol>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('panel.campuses.store') }}" method="POST">
                            @csrf
                            <div>
                            <div class="input-group mb-2">
                                <label class="p-2 col-lg-3">Campus: </label>
                                <div class="col-lg-9">
                                    <input type="text" name="campus_name" value="{{ old('campus_name') }}" class="form-control" placeholder="Please enter campus name">
                                </div>
                            </div>
                            <div class="input-group mb-2">
                                <label class="p-2 col-lg-3">Address: </label>
                                <div class="col-lg-9">
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control" placeholder="Please enter campus address">
                                </div>
                            </div>
                            <div class="input-group mb-2">
                                <label class="p-2 col-lg-3">Map Color: </label>
                                <div class="col-lg-9">
                                    <input type="color" name="map_color" value="{{ old('map_color') }}" class="form-control">
                                </div>
                            </div> 
                            <input type="hidden" name="status" value="active">
                            <hr>
                            <button type="submit" class="btn btn-info">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection