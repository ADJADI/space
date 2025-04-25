@extends('admin.layouts.app')

@section('title', 'Technologies - Space Admin')

@section('header', 'Technologies')

@section('header_buttons')
    <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Technology
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
                            <th>Name</th>
                            <th>Subtitle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technologies as $technology)
                            <tr>
                                <td>{{ $technology->id }}</td>
                                <td>
                                    @if ($technology->srcm)
                                        <img src="{{ $technology->srcm }}" alt="{{ $technology->title }}" width="50" height="50" class="rounded">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $technology->title }}</td>
                                <td>{{ $technology->subtitle }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.technologies.show', $technology->id) }}" class="btn btn-sm btn-info me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this technology?')">
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
                                <td colspan="5" class="text-center">No technologies found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 