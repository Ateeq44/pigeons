@extends('admin.layouts.app')
@section('title','Edit Slider')

@section('content')

<div class="row">
  <div class="col-xl-12">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header" id="top">
          <h2 class="pageheader-title">Edit Slider</h2>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Slider</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- basic form  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
          <h5 class="card-header">Edit Slider</h5>
          <div class="card-body">
            <form method="POST" action="{{ route('admin.sliders.update',$slider) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row g-3">
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
                    <img src="{{ asset($slider->image_path) }}" style="width:100%;max-width:520px;height:180px;object-fit:cover;border-radius:12px;">
                  </div>

                  <label class="form-label">Replace Image (optional)</label>
                  <input type="file" class="form-control" name="image">
                </div>

                <div class="col-12 mt-4">
                  <button class="btn btn-success">Update</button>
                  <a href="{{ route('admin.sliders.index') }}" class="btn btn-secondary">Back</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
