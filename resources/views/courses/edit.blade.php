@extends('layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Update Course</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Fill Details</li>   
            </ol>
            <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                        <label>Course </label>
                        <input type="text" name="course_name" class="form-control" value="{{ $course->course_name }}">
                        </div>
                        <select name="status" id="status" class="form-control">
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                        <button type="submit" class="btn btn-info">Update</button>
                    </form>
            </div>
        </div>
    </main>
@endsection