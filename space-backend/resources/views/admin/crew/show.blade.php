@extends('admin.layouts.app')

@section('title', $crew->title . ' - Space Admin')

@section('header', 'View Crew Member')

@section('header_buttons')
    <div>
        <a href="{{ route('admin.crew.edit', $crew->id) }}" class="btn btn-primary me-2">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="{{ route('admin.crew.destroy', $crew->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this crew member?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Crew Member Details</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">ID</th>
                                <td>{{ $crew->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $crew->title }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ $crew->subtitle }}</td>
                            </tr>
                            <tr>
                                <th>Alt Text</th>
                                <td>{{ $crew->alt ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $crew->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $crew->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Biography</h5>
                </div>
                <div class="card-body">
                    <p>{{ $crew->content }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Images</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">Mobile</div>
                                <div class="card-body text-center">
                                    @if($crew->srcm)
                                        <img src="{{ $crew->srcm }}" alt="Mobile image" class="img-fluid mb-2" style="max-height: 200px;">
                                        <a href="{{ $crew->srcm }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                                    @else
                                        <div class="text-muted">No image</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">Tablet</div>
                                <div class="card-body text-center">
                                    @if($crew->srct)
                                        <img src="{{ $crew->srct }}" alt="Tablet image" class="img-fluid mb-2" style="max-height: 200px;">
                                        <a href="{{ $crew->srct }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                                    @else
                                        <div class="text-muted">No image</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">Desktop</div>
                                <div class="card-body text-center">
                                    @if($crew->srcd)
                                        <img src="{{ $crew->srcd }}" alt="Desktop image" class="img-fluid mb-2" style="max-height: 200px;">
                                        <a href="{{ $crew->srcd }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
                                    @else
                                        <div class="text-muted">No image</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('admin.crew.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Crew
        </a>
    </div>
@endsection 