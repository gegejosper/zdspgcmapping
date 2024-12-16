@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <div>
                    <h1 class="h2">Campus Details</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/panel/dashboard" class="text-decoration-none">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('panel.campuses.index') }}" class="text-decoration-none">Campuses</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $campus->campus_name }}</li>
                    </ol>
                </div>
                <a href="{{ route('panel.campuses.index') }}" class="btn btn-warning">
                    <i class="fa fa-arrow-left me-2"></i> Back to Campus List
                </a>
            </div>

            <!-- Campus Details Card -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h2 class="card-title text-primary fw-bold mb-3">{{ $campus->campus_name }}</h2>
                    <p class="text-muted mb-0"><strong>Address:</strong> {{ $campus->address }}</p>
                </div>
            </div>

            <!-- Students Table -->
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Students Enrolled</h5>
                    <span class="badge bg-primary">{{ $students->count() }} Students</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Middle Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Campus</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->middle_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->campus_details->campus_name }}</td>
                                <td class="text-center">
                                    <!-- <a href="{{ route('panel.students.show', $student->id) }}" class="btn btn-sm btn-success me-2">
                                        <i class="fa fa-search"></i> View
                                    </a> -->
                                    <a href="{{ route('panel.students.edit', $student->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <!-- <form action="{{ route('panel.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i> Delete
                                        </button>
                                    </form> -->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No students are currently enrolled in this campus.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection