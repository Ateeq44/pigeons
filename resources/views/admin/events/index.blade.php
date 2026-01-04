@extends('admin.layouts.app')

@section('title', 'Events')

@section('content')
<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
            <div class="page-header">
                <h2 class="pageheader-title">Events</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Events
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div>    
                <a href="{{ route('admin.events.create') }}" class="btn btn-success btn-sm">+ Add Club</a>
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
                <h5 class="card-header">Events</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first" id="clubsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Club</th>
                                    <th>Title</th>
                                    <th>Start Time</th>
                                    <th>Date Range</th>
                                    <th>Pigeons</th>
                                    <th>Featured</th>
                                    <th style="width:170px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $key => $e)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $e->club?->name_ur }}</td>
                                    <td>{{ $e->title_ur }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $e->start_time)->format('H:i') }}</td>
                                    <td>{{ $e->start_date->format('Y-m-d') }} → {{ $e->end_date->format('Y-m-d') }}</td>
                                    <td>{{ $e->pigeons_per_loft }}</td>
                                    <td>{!! $e->is_featured ? '<span class="badge badge-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
                                    <td class="d-flex gap-2">
                                        <a class="mr-2 btn btn-primary btn-sm" href="{{ route('admin.events.edit', $e) }}">Edit</a>
                                        <a class="mr-2 btn btn-secondary btn-sm" href="{{ route('admin.events.days.index', $e) }}">Days</a>
                                        <a class="mr-2 btn btn-warning btn-sm" href="{{ route('admin.events.participants.index', $e) }}">Participants</a>

                                        <form method="POST" action="{{ route('admin.events.destroy', $e) }}"
                                        onsubmit="return confirm('Delete this event?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
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

@push('scripts')
<script>
  $(function(){
    $('#eventsTable').DataTable({ pageLength: 25 });
});
</script>
@endpush
