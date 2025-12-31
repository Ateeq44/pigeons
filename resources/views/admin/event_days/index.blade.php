@extends('admin.layouts.app')

@section('title', 'Event Days')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Event Days</h4>
        <div class="text-muted">
            <b>{{ $event->title_ur }}</b> — {{ $event->start_date->format('Y-m-d') }} → {{ $event->end_date->format('Y-m-d') }}
            | Start Time: {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i') }}
            | Pigeons: {{ $event->pigeons_per_loft }}
        </div>
    </div>

    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.days.generate', $event) }}" class="row g-3 align-items-end">
            @csrf

            <div class="col-md-4">
                <label class="form-label">Override pigeons for ALL days (optional)</label>
                <select name="pigeons_per_loft" class="form-select">
                    <option value="">Use event default ({{ $event->pigeons_per_loft }})</option>
                    @for($i=1;$i<=10;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="form-text">Empty چھوڑ دیں تو day null رہے گا اور event والا count use ہوگا۔</div>
            </div>

            <div class="col-md-3">
                <button class="btn btn-success">Generate Days</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered" id="daysTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Pigeons Count (Resolved)</th>
                    <th style="width:150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($days as $i => $day)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $day->day_date->format('Y-m-d') }}</td>
                    <td>{{ $day->pigeonsCount() }}</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.arrivals.edit', [$event, $day]) }}">Arrivals</a>

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
@endsection

@push('scripts')
<script>
  $(function(){
    $('#daysTable').DataTable({ pageLength: 25 });
  });
</script>
@endpush
