@extends('admin.layouts.app')

@section('title', 'Event Days')

@section('content')

<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
            <div class="page-header">
                <h2 class="pageheader-title">Event Days</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Event Days
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="text-muted">
                <b>{{ $event->title_ur }}</b> — {{ $event->start_date->format('Y-m-d') }} → {{ $event->end_date->format('Y-m-d') }}
                | Start Time: {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i') }}
                | Pigeons: {{ $event->pigeons_per_loft }}
            </div>
            <form method="POST" action="{{ route('admin.events.days.generate', $event) }}" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-3">
                    <small class="text-danger">Click on this button for generating days</small><br>
                    <button class="btn btn-success">Generate Days</button>
                </div>
            </form>
        </div>
        </div
        <!-- ============================================================== -->
        <!-- end pageheader -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- ============================================================== -->
            <!-- basic table  -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Event Days</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered first" id="clubsTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Pigeons Count (Resolved)</th>
                                        <th style="width:150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($days as $key => $day)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $day->day_date->format('Y-m-d') }}</td>
                                        <td>{{ $day->pigeonsCount() }}</td>
                                        <td class="d-flex gap-2">
                                            <a class="btn btn-primary btn- mr-2" href="{{ route('admin.arrivals.edit', [$event, $day]) }}">Arrivals</a>

                                            <form method="POST" action="{{ route('admin.events.days.destroy', [$event, $day]) }}"
                                            onsubmit="return confirm('Delete this day?')">
                                            @csrf
                                            @method('DELETE')
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

@push('scripts')
<script>
  $(function(){
    $('#daysTable').DataTable({ pageLength: 25 });
});
</script>
@endpush
