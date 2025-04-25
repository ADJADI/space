@extends('admin.layouts.app')

@section('title', 'Crew Members - Space Admin')

@section('header', 'Crew Members')

@section('header_buttons')
    <a href="{{ route('admin.crew.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Crew Member
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
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($crewMembers as $crewMember)
                            <tr>
                                <td>{{ $crewMember->id }}</td>
                                <td>
                                    @if ($crewMember->srcm)
                                        <img src="{{ $crewMember->srcm }}" alt="{{ $crewMember->title }}" width="50" height="50" class="rounded">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $crewMember->title }}</td>
                                <td>{{ $crewMember->subtitle }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.crew.show', $crewMember->id) }}" class="btn btn-sm btn-info me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.crew.edit', $crewMember->id) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.crew.destroy', $crewMember->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this crew member?')">
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
                                <td colspan="5" class="text-center">No crew members found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection 