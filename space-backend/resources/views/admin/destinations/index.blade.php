@extends('admin.layouts.app')

@section('title', 'Destinations - Space Admin')

@section('header', 'Destinations')

@section('header_buttons')
    <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Destination
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Distance</th>
                            <th>Travel Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($destinations as $destination)
                            <tr>
                                <td>{{ $destination->id }}</td>
                                <td>
                                    @if ($destination->srcm)
                                        <img src="{{ $destination->srcm }}" alt="{{ $destination->title }}" width="50" height="50" class="rounded">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $destination->title }}</td>
                                <td>{{ $destination->km }}</td>
                                <td>{{ $destination->days }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.destinations.show', $destination->id) }}" class="btn btn-sm btn-info me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destination?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No destinations found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 