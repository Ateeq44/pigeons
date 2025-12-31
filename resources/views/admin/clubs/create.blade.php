@extends('admin.layouts.app')

@section('title', 'Add Club')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Add Club</h4>
    <a href="{{ route('admin.clubs.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.clubs.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Club Name (Urdu)</label>
                <input type="text" name="name_ur" class="form-control" value="{{ old('name_ur') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug (optional)</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="auto-generate if empty">
                <div class="form-text">Example: pipla-nitefaq</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0">
            </div>

            <button class="btn btn-success">Save</button>
        </form>
    </div>
</div>
@endsection
