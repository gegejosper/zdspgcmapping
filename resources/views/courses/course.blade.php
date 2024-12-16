@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <div>
                    <h1 class="h2">Course Details</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('panel.courses.index') }}">Courses</a>
                        </li>
                        <li class="breadcrumb-item active">Details</li>
                    </ol>
                </div>
                <a href="{{ route('panel.courses.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left me-2"></i>Back to Course List
                </a>
            </div>

            <!-- Course Details -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="card-title text-primary">{{ $course->course_name }}</h3>
                    <p class="card-text"><strong>Status:</strong> <span class="badge {{ $course->status === 'Active' ? 'bg-success' : 'bg-danger' }}">{{ $course->status }}</span></p>
                </div>
            </div>

            <!-- Students Table -->
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Enrolled Students</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Middle Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Course</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->course_details->course_name }}</td>
                                <td>
                                    <!-- <a href="{{ route('panel.students.show', $student->id) }}" class="btn btn-sm btn-success me-2">
                                        <i class="fa fa-search"></i> View
                                    </a> -->
                                    <a href="{{ route('panel.students.edit', $student->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('panel.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No students enrolled in this course.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection