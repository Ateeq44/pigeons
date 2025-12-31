@extends('layouts.public')

@section('title', 'Home')

@section('content')
@if(!$event)
<div class="alert alert-warning">
    No featured event found. Please mark one event as featured in admin.
</div>
@else

<div class="mb-3">
    <h4 class="mb-1">{{ $event->title_ur }}</h4>
    <div class="text-muted">
        Club: <b>{{ $event->club?->name_ur }}</b> |
        Start: {{ \Carbon\Carbon::createFromFormat('H:i:s',$event->start_time)->format('H:i') }}
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        {{-- Tabs bar (visual like reference) --}}
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
            @foreach($days as $d)
            <a class="btn btn-outline-primary btn-sm" href="{{ route('public.day', $d) }}">
                {{ $d->day_date->format('d F, Y') }}
            </a>
            @endforeach
            <span class="btn btn-primary btn-sm">Total</span>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="resultsTable">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Pigeons</th>

                        @foreach($days as $d)
                        <th>{{ $d->day_date->format('Y-m-d') }}</th>
                        @endforeach

                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($rows as $r)
                    <tr>
                        <td>{{ $r->position }}</td>

                        <td style="width:70px;">
                            @if($r->photo_path)
                            <img src="{{ asset($r->photo_path) }}"
                            style="width:44px;height:44px;border-radius:50%;object-fit:cover;">
                            @else
                            <div class="bg-secondary-subtle" style="width:44px;height:44px;border-radius:50%;"></div>
                            @endif
                        </td>

                        <td>{{ $r->name_ur }} <div class="text-muted small">{{ $r->city_ur ?? '' }}</div></td>

                        <td>{{ $r->pigeons_total ?? '—' }}</td>

                        @foreach($days as $d)
                        <td>{{ $r->days[$d->id]['hms'] ?? '' }}</td>
                        @endforeach

                        <td class="fw-bold">{{ $r->grand_hms }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 5 + $days->count() }}" class="text-center text-muted">
                            No data yet. Please enter arrivals in admin.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endif
@endsection

@push('scripts')
<script>
  $(function(){
    $('#resultsTable').DataTable({
      scrollX: true,
      pageLength: 50
  });
});
</script>
@endpush
