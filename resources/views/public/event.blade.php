@extends('layouts.public')

@section('title', 'Event Result')

@section('content')
<div class="mb-3">
    <div class="p-3 text-white rounded" style="background:#198754;">
        <div class="fw-bold" style="font-size:20px;">
            {{ $event->title_ur }}
        </div>
        <div class="small">
            Club: {{ $event->club?->name_ur }} |
            Start time: {{ \Carbon\Carbon::createFromFormat('H:i:s',$event->start_time)->format('H:i') }}
        </div>
    </div>
</div>

{{-- Tabs --}}
<div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
    @foreach($days as $d)
        <a class="btn btn-sm btn-outline-primary"
           href="{{ route('public.day', $d) }}">
            {{ $d->day_date->format('d F, Y') }}
        </a>
    @endforeach
    <span class="btn btn-sm btn-primary">Total</span>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="eventTotalTable">
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
                        <th>Prize</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($rows as $r)
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

                        <td>
                            {{ $r->name_ur }}
                            <div class="text-muted small">{{ $r->city_ur ?? '' }}</div>
                        </td>

                        <td>{{ $r->pigeons_total ?? '—' }}</td>

                        @foreach($days as $d)
                            <td>{{ $r->days[$d->id]['hms'] ?? '' }}</td>
                        @endforeach

                        <td class="fw-bold">{{ $r->grand_hms }}</td>
                        <td>{{ $r->prize_amount ?? '—' }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
  $(function(){
    $('#eventTotalTable').DataTable({
      scrollX: true,
      pageLength: 50
    });
  });
</script>
@endpush
