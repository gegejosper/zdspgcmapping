@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Course</h1>
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
                        <form action="{{ route('panel.courses.update', $course->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="input-group mb-2">
                                    <label class="p-2 col-lg-3">Course: </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="course_name" class="form-control" value="{{ $course->course_name }}">
                                    </div>
                                </div>
                                <div class="input-group mb-2 col-lg-6">
                                    <label class="p-2 col-lg-3">Status: </label>
                                    <div class="col-lg-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="active" @if($course->status =='active') selected @endif>active</option>
                                            <option value="inactive" @if($course->status =='inactive') selected @endif>inactive</option>
                                        </select>
                                    </div>
                                </div>
                            
                            </div>
                           
                            <hr>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
@endsection