@extends('layouts.public')

@section('title', 'Events')

@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <h4 class="mb-0">All Events</h4>
    <a href="{{ route('public.home') }}" class="btn btn-outline-secondary btn-sm">Home</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        @if($events->count() === 0)
            <div class="text-muted">No events found.</div>
        @else
            <div class="list-group">
                @foreach($events as $e)
                    <a class="list-group-item list-group-item-action" href="{{ route('public.event', $e) }}"
>
                        <div class="fw-semibold">{{ $e->title_ur }}</div>
                        <div class="text-muted small">
                            Club: {{ $e->club?->name_ur }} |
                            {{ $e->start_date->format('Y-m-d') }} → {{ $e->end_date->format('Y-m-d') }}
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
