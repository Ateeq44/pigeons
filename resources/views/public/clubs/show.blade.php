@extends('layouts.public')

@section('title', $club->name_ur)

@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <div>
        <h4 class="mb-0">{{ $club->name_ur }}</h4>
        <div class="text-muted small">{{ $club->slug }}</div>
    </div>
    <a href="{{ route('public.clubs') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if($events->count() === 0)
            <div class="text-muted">No events for this club.</div>
        @else
            <div class="list-group">
                @foreach($events as $e)
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('public.event', $e) }}">
                        <div class="fw-semibold">{{ $e->title_ur }}</div>
                        <div class="text-muted small">
                            {{ $e->start_date->format('Y-m-d') }} → {{ $e->end_date->format('Y-m-d') }}
                            | Start: {{ \Carbon\Carbon::createFromFormat('H:i:s',$e->start_time)->format('H:i') }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection