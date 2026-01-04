@extends('admin.layouts.app')

@section('title', 'Edit Loft')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Edit Loft</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Loft</li>
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
                    <h5 class="card-header">Edit Loft</h5>
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
                                <img src="{{ asset($loft->photo_path) }}" style="width:70px;height:70px;border-radius:50%;object-fit:cover;">
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
            </div>
        </div>
    </div>
</div>

@endsection
