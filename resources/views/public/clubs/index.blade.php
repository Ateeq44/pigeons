@extends('layouts.public')

@section('title', 'Clubs')

@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Clubs</h4>
    <a href="{{ route('public.home') }}" class="btn btn-outline-secondary btn-sm">Home</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        @if($clubs->count() === 0)
            <div class="text-muted">No clubs found.</div>
        @else
            <div class="list-group">
                @foreach($clubs as $c)
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('public.clubs.show', $c) }}">
                        <div class="fw-semibold">{{ $c->name_ur }}</div>
                        <div class="text-muted small">{{ $c->slug }}</div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
