@extends('admin.layouts.app')

@section('title', $destination->title . ' - Space Admin')

@section('header', 'View Destination')

@section('header_buttons')
    <div>
        <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-primary me-2">
            <i class="bi bi-pencil"></i> Edit
        </a>
        <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this destination?')">
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
                    <h5 class="card-title mb-0">Destination Details</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width: 30%">ID</th>
                                <td>{{ $destination->id }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td>{{ $destination->title }}</td>
                            </tr>
                            <tr>
                                <th>Distance</th>
                                <td>{{ $destination->km }}</td>
                            </tr>
                            <tr>
                                <th>Travel Time</th>
                                <td>{{ $destination->days }}</td>
                            </tr>
                            <tr>
                                <th>Alt Text</th>
                                <td>{{ $destination->alt ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $destination->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $destination->updated_at->format('M d, Y H:i') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Description</h5>
                </div>
                <div class="card-body">
                    <p>{{ $destination->content }}</p>
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
                                    @if($destination->srcm)
                                        <img src="{{ $destination->srcm }}" alt="Mobile image" class="img-fluid mb-2" style="max-height: 200px;">
                                        <a href="{{ $destination->srcm }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
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
                                    @if($destination->srct)
                                        <img src="{{ $destination->srct }}" alt="Tablet image" class="img-fluid mb-2" style="max-height: 200px;">
                                        <a href="{{ $destination->srct }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
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
                                    @if($destination->srcd)
                                        <img src="{{ $destination->srcd }}" alt="Desktop image" class="img-fluid mb-2" style="max-height: 200px;">
                                        <a href="{{ $destination->srcd }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
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
        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Destinations
        </a>
    </div>
@endsection 