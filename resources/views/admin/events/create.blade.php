@extends('admin.layouts.app')

@section('title', 'Add Event')

@section('content')

<div class="row">
    <div class="col-xl-12">
        <!-- ============================================================== -->
        <!-- pageheader  -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header" id="top">
                    <h2 class="pageheader-title">Add Events</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Events</li>
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
                    <h5 class="card-header">Add Events</h5>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.events.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Club</label>
                <select name="club_id" class="form-control" required>
                    <option value="">Select Club</option>
                    @foreach($clubs as $c)
                        <option value="{{ $c->id }}" @selected(old('club_id')==$c->id)>{{ $c->name_ur }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Title (Urdu)</label>
                <input type="text" name="title_ur" class="form-control" value="{{ old('title_ur') }}" required>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control" value="{{ old('start_time','06:00') }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-4">
                    <label class="form-label">Pigeons Per Loft (1-10)</label>
                    <select name="pigeons_per_loft" class="form-control" required>
                        @for($i=1;$i<=10;$i++)
                            <option value="{{ $i }}" @selected(old('pigeons_per_loft',5)==$i)>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured'))>
                        <label class="form-check-label" for="is_featured">Featured on Home</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',0) }}" min="0">
                </div>
            </div>

            <button class="btn btn-success mt-3">Save</button>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
