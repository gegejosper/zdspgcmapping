@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Create Student</h1>
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
                    <div class="card-body">
                        <form action="{{ route('panel.students.update', $student->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mb-10">
                                <div class="col-lg-3">
                                    <label>First Name </label>
                                    <input type="text" name="first_name" value="{{ $student->first_name }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                <label>Middle Name </label>
                                <input type="text" name="middle_name" value="{{ $student->middle_name }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                <label>Last Name </label>
                                <input type="text" name="last_name" value="{{ $student->last_name }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Course</label>
                                    <select name="course_id" id="course_id" class="form-control">
                                        <option value="{{$student->course_details->id}}">{{$student->course_details->course_name}}</option>
                                        @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row  mt-5">
                                <div class="col-lg-3">
                                    <label>Address </label>
                                    <input type="text" name="address" value="{{ $student->address }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                    <label>Municipality</label>
                                    <input type="text" name="municipality" value="{{ $student->municipality }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                    <label>Province</label>
                                    <input type="text" name="province" value="{{ $student->province }}" class="form-control">
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Year Level</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="{{ $student->year }}">{{ $student->year }}</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-3">
                                    <label for="">Scholarship</label>
                                    <select name="scholarship_id" id="scholarship_id" class="form-control">
                                        @if($student->scholarship_details != null)
                                            <option value="{{ $student->scholarship_details->id }}">{{ $student->scholarship_details->scholarship_name }}</option>
                                        @endif
                                        
                                        <option value="0">NONE</option>
                                        @foreach($scholarships as $scholarship)
                                        <option value="{{$scholarship->id}}">{{$scholarship->scholarship_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Campus</label>
                                    <select name="campus_id" id="campus_id" class="form-control">
                                        <option value="{{ $student->campus_details->id }}">{{ $student->campus_details->campus_name }}</option>
                                        @foreach($campuses as $campus)
                                        <option value="{{$campus->id}}">{{$campus->campus_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="{{ $student->status }}">{{ ucfirst($student->status) }}</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="graduated">Graduated</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info mt-5">Update</button>
                        </form>
                    </div>
            </div>
        </div>
    </main>
@endsection