@extends('admin.layouts.app')

@section('title', 'Create Destination - Space Admin')

@section('header', 'Create Destination')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="km" class="form-label">Distance (km)</label>
                        <input type="text" class="form-control @error('km') is-invalid @enderror" id="km" name="km" value="{{ old('km') }}" required>
                        @error('km')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="days" class="form-label">Travel Time</label>
                        <input type="text" class="form-control @error('days') is-invalid @enderror" id="days" name="days" value="{{ old('days') }}" required>
                        @error('days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="alt" class="form-label">Alt Text</label>
                    <input type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" name="alt" value="{{ old('alt') }}">
                    @error('alt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="srcm" class="form-label">Mobile Image</label>
                        <input type="file" class="form-control @error('srcm') is-invalid @enderror" id="srcm" name="srcm">
                        @error('srcm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="srct" class="form-label">Tablet Image</label>
                        <input type="file" class="form-control @error('srct') is-invalid @enderror" id="srct" name="srct">
                        @error('srct')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="srcd" class="form-label">Desktop Image</label>
                        <input type="file" class="form-control @error('srcd') is-invalid @enderror" id="srcd" name="srcd">
                        @error('srcd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Destination</button>
                </div>
            </form>
        </div>
    </div>
@endsection 