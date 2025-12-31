@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Dashboard</h4>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted">Total Clubs</div>
                <div class="fs-2 fw-bold">{{ $stats['clubs'] }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted">Total Events</div>
                <div class="fs-2 fw-bold">{{ $stats['events'] }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="text-muted">Total Lofts</div>
                <div class="fs-2 fw-bold">{{ $stats['lofts'] }}</div>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<div class="card shadow-sm">
    <div class="card-body">
        <div class="fw-bold mb-2">Next Steps</div>
        <ol class="mb-0">
            <li>Clubs CRUD</li>
            <li>Events CRUD</li>
            <li>Event Days Generator</li>
            <li>Participants Attach + Arrivals Entry</li>
        </ol>
    </div>
</div>
@endsection
