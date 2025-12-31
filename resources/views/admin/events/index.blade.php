@extends('admin.layouts.app')

@section('title', 'Events')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Events</h4>
    <a href="{{ route('admin.events.create') }}" class="btn btn-success btn-sm">+ Add Event</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="eventsTable">
            <thead>
                <tr>
                    <th>ID</th>
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
                @foreach($events as $e)
                <tr>
                    <td>{{ $e->id }}</td>
                    <td>{{ $e->club?->name_ur }}</td>
                    <td>{{ $e->title_ur }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $e->start_time)->format('H:i') }}</td>
                    <td>{{ $e->start_date->format('Y-m-d') }} → {{ $e->end_date->format('Y-m-d') }}</td>
                    <td>{{ $e->pigeons_per_loft }}</td>
                    <td>{!! $e->is_featured ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.events.edit', $e) }}">Edit</a>
                        <a class="btn btn-secondary btn-sm" href="{{ route('admin.events.days.index', $e) }}">Days</a>
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.events.participants.index', $e) }}">Participants</a>

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
@endsection

@push('scripts')
<script>
  $(function(){
    $('#eventsTable').DataTable({ pageLength: 25 });
  });
</script>
@endpush
