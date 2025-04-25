@extends('admin.layouts.app')

@section('title', 'Edit Technology - Space Admin')

@section('header', 'Edit Technology')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $technology->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="subtitle" class="form-label">Subtitle</label>
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" value="{{ old('subtitle', $technology->subtitle) }}" required>
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Description</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="5" required>{{ old('content', $technology->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="alt" class="form-label">Alt Text</label>
                    <input type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" name="alt" value="{{ old('alt', $technology->alt) }}">
                    @error('alt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <label for="srcm" class="form-label">Mobile Image</label>
                        @if($technology->srcm)
                            <div class="mb-2">
                                <img src="{{ $technology->srcm }}" alt="Current mobile image" class="img-thumbnail" style="max-height: 150px;">
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
                        @if($technology->srct)
                            <div class="mb-2">
                                <img src="{{ $technology->srct }}" alt="Current tablet image" class="img-thumbnail" style="max-height: 150px;">
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
                        @if($technology->srcd)
                            <div class="mb-2">
                                <img src="{{ $technology->srcd }}" alt="Current desktop image" class="img-thumbnail" style="max-height: 150px;">
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
                    <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Technology</button>
                </div>
            </form>
        </div>
    </div>
@endsection 