@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <div>
                    <h1 class="h2">Campuses</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/panel/dashboard" class="text-decoration-none">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">List of Campuses</li>
                    </ol>
                </div>
                <a href="/panel/dashboard" class="btn btn-warning">
                    <i class="fa fa-arrow-left me-2"></i> Back to Dashboard
                </a>
            </div>

            <!-- Success Message -->
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Campuses Table Card -->
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Campuses List</h5>
                    <a href="/panel/campuses/create" class="btn btn-info">
                        <i class="fa fa-plus me-2"></i>Add Campus
                    </a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <!-- <th scope="col">Map Color</th> -->
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($campuses as $campus)
                            <tr>
                                <td>{{ $campus->id }}</td>
                                <td>{{ $campus->campus_name }}</td>
                                <td>{{ $campus->address }}</td>
                                <!-- <td>
                                    <span class="badge" style="background-color: {{ $campus->map_color }};">
                                        {{ $campus->map_color }}
                                    </span>
                                </td> -->
                                <td class="text-center">
                                    <a href="{{ route('panel.campuses.show', $campus->id) }}" class="btn btn-sm btn-success me-2">
                                        <i class="fa fa-search"></i> View
                                    </a>
                                    <a href="{{ route('panel.campuses.edit', $campus->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <!-- Uncomment the following block for delete functionality -->
                                    <!--
                                    <form action="{{ route('panel.campuses.destroy', $campus->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-times"></i> Delete
                                        </button>
                                    </form>
                                    -->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No campuses available.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection