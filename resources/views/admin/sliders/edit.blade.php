@extends('admin.layouts.app')
@section('title','Edit Slider')

@section('content')
<h4 class="mb-3">Edit Slider</h4>

<form method="POST" action="{{ route('admin.sliders.update',$slider) }}" enctype="multipart/form-data" class="card">
  @csrf
  @method('PUT')

  <div class="card-body row g-3">
    <div class="col-md-6">
      <label class="form-label">Title</label>
      <input class="form-control" name="title" value="{{ old('title', $slider->title) }}">
    </div>

    <div class="col-md-6">
      <label class="form-label">Link URL (optional)</label>
      <input class="form-control" name="link_url" value="{{ old('link_url', $slider->link_url) }}">
    </div>

    <div class="col-md-4">
      <label class="form-label">Sort Order</label>
      <input type="number" class="form-control" name="sort_order" min="0"
             value="{{ old('sort_order', $slider->sort_order) }}">
    </div>

    <div class="col-md-4">
      <label class="form-label">Active</label>
      <div class="form-check mt-2">
        <input class="form-check-input" type="checkbox" name="is_active" value="1"
               {{ old('is_active', $slider->is_active) ? 'checked' : '' }}>
        <label class="form-check-label">Show on site</label>
      </div>
    </div>

    <div class="col-md-12">
      <label class="form-label">Current Image</label>
      <div class="mb-2">
        <img src="{{ asset('storage/'.$slider->image_path) }}"
             style="width:100%;max-width:520px;height:180px;object-fit:cover;border-radius:12px;">
      </div>

      <label class="form-label">Replace Image (optional)</label>
      <input type="file" class="form-control" name="image">
      <div class="form-text">اگر نئی image نہ دیں تو پرانی image رہے گی۔</div>
    </div>

    <div class="col-12">
      <button class="btn btn-success">Update</button>
      <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Back</a>
    </div>
  </div>
</form>
@endsection
