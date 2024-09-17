@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Course</h1>
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
                        <form action="{{ route('panel.courses.store') }}" method="POST">
                            @csrf
                            <div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-3">Course: </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="course_name" value="{{ old('course_name') }}" class="form-control" placeholder="Please enter course">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" name="status" value="active">
                            <button type="submit" class="btn btn-info">Create</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection