@extends('admin.layouts.app')
@section('title','Sliders')

@section('content')

<div class="container-fluid dashboard-content">
  <!-- ============================================================== -->
  <!-- pageheader -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
      <div class="page-header">
        <h2 class="pageheader-title">Sliders</h2>
        <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Sliders
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <div>    
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-success btn-sm">+ Add Slider</a>
      </div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- end pageheader -->
  <!-- ============================================================== -->
  <div class="row">
    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <h5 class="card-header">Sliders</h5>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead>
                <tr>
                  <th>#</th><th>Image</th><th>Title</th><th>Active</th><th>Sort</th><th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($sliders as $key => $s)
                <tr>
                  <td>{{ ++$key }}</td>
                  <td style="width:120px;">
                    <img src="{{ asset($s->image_path) }}" style="width:110px;height:55px;object-fit:cover;border-radius:8px;">
                  </td>
                  <td>{{ $s->title ?? '—' }}</td>
                  <td>{{ $s->is_active ? 'Yes' : 'No' }}</td>
                  <td>{{ $s->sort_order }}</td>
                  <td class="d-flex gap-2">
                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('admin.sliders.edit',$s) }}">Edit</a>
                    <form method="POST" action="{{ route('admin.sliders.destroy',$s) }}" onsubmit="return confirm('Delete?')">
                      @csrf @method('DELETE')
                      <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
  </div>
</div>

@endsection
