@extends('admin.layouts.app')

@section('title', 'Edit Loft')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Edit Loft</h4>
    <a href="{{ route('admin.lofts.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.lofts.update', $loft) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name (Urdu)</label>
                <input type="text" name="name_ur" class="form-control" value="{{ old('name_ur', $loft->name_ur) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">City (Urdu)</label>
                <input type="text" name="city_ur" class="form-control" value="{{ old('city_ur', $loft->city_ur) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Current Photo</label><br>
                @if($loft->photo_path)
                    <img src="{{ asset('storage/'.$loft->photo_path) }}" style="width:70px;height:70px;border-radius:50%;object-fit:cover;">
                @else
                    <span class="text-muted">No photo</span>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Change Photo (optional)</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $loft->sort_order) }}" min="0">
            </div>

            <button class="btn btn-success">Update</button>
        </form>
    </div>
</div>
@endsection
