@extends('layouts.layout')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                <div>
                    <h1 class="h2">Update Scholarship</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/panel/dashboard" class="text-decoration-none">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('panel.scholarships.index') }}" class="text-decoration-none">Scholarships</a>
                        </li>
                        <li class="breadcrumb-item active">Update Scholarship</li>
                    </ol>
                </div>
            </div>

            <!-- Form Section -->
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow p-4">
                        <!-- Error Handling -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Update Form -->
                        <form action="{{ route('panel.scholarships.update', $scholarship->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Scholarship Name -->
                            <div class="mb-3">
                                <label for="scholarship_name" class="form-label">Scholarship Name</label>
                                <input 
                                    type="text" 
                                    id="scholarship_name" 
                                    name="scholarship_name" 
                                    class="form-control @error('scholarship_name') is-invalid @enderror" 
                                    value="{{ old('scholarship_name', $scholarship->scholarship_name) }}" 
                                    required>
                                @error('scholarship_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="text-end">
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-save me-2"></i> Update Scholarship
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection