@extends('admin.layouts.app')

@section('title', 'Edit Club')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Edit Club</h4>
    <a href="{{ route('admin.clubs.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.clubs.update', $club) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Club Name (Urdu)</label>
                <input type="text" name="name_ur" class="form-control" value="{{ old('name_ur', $club->name_ur) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $club->slug) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $club->sort_order) }}" min="0">
            </div>

            <button class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
