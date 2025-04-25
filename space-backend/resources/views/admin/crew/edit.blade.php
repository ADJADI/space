@extends('admin.layouts.app')

@section('title', 'Edit Crew Member - Space Admin')

@section('header', 'Edit Crew Member')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.crew.update', $crew->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Name</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $crew->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Role</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $crew->subtitle) }}" required>
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Biography</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $crew->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="alt" class="form-label">Alt Text</label>
                    <input type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" name="alt" value="{{ old('alt', $crew->alt) }}">
                    @error('alt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="srcm" class="form-label">Mobile Image</label>
                        @if($crew->srcm)
                            <div class="mb-2">
                                <img src="{{ $crew->srcm }}" alt="Current mobile image" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('srcm') is-invalid @enderror" id="srcm" name="srcm">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                        @error('srcm')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <label for="srct" class="form-label">Tablet Image</label>
                        @if($crew->srct)
                            <div class="mb-2">
                                <img src="{{ $crew->srct }}" alt="Current tablet image" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('srct') is-invalid @enderror" id="srct" name="srct">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                        @error('srct')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <label for="srcd" class="form-label">Desktop Image</label>
                        @if($crew->srcd)
                            <div class="mb-2">
                                <img src="{{ $crew->srcd }}" alt="Current desktop image" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        @endif
                        <input type="file" class="form-control @error('srcd') is-invalid @enderror" id="srcd" name="srcd">
                        <small class="form-text text-muted">Leave empty to keep current image</small>
                        @error('srcd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.crew.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Crew Member</button>
                </div>
            </form>
        </div>
    </div>
@endsection 