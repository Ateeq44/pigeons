@extends('admin.layouts.app')
@section('title','Add Slider')

@section('content')
<h4 class="mb-3">Add Slider</h4>

<form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data" class="card">
  @csrf
  <div class="card-body row g-3">
    <div class="col-md-6">
      <label class="form-label">Title</label>
      <input class="form-control" name="title">
    </div>
    <div class="col-md-6">
      <label class="form-label">Link URL (optional)</label>
      <input class="form-control" name="link_url">
    </div>

    <div class="col-md-4">
      <label class="form-label">Sort Order</label>
      <input type="number" class="form-control" name="sort_order" value="0" min="0">
    </div>

    <div class="col-md-4">
      <label class="form-label">Active</label>
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
        <label class="form-check-label">Show on site</label>
      </div>
    </div>

    <div class="col-md-12">
      <label class="form-label">Image</label>
      <input type="file" class="form-control" name="image" required>
    </div>

    <div class="col-12">
      <button class="btn btn-success">Save</button>
      <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</form>
@endsection
