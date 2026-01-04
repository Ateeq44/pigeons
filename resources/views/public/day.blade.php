@extends('layouts.public')

@section('title', 'Day Result')

@section('content')
<div class="mb-3">
    <div class="p-3 text-white rounded" style="background:#3f51b5;">
        <div class="fw-bold" style="font-size:20px;">
            {{ $event->title_ur }} — Start time: {{ \Carbon\Carbon::createFromFormat('H:i:s',$event->start_time)->format('H:i') }}
        </div>
    </div>
</div>

{{-- Tabs --}}
<div class="d-flex justify-content-center flex-wrap gap-2 mb-3">
    @foreach($days as $d)
        <a class="btn btn-sm {{ $d->id === $day->id ? 'btn-primary' : 'btn-outline-primary' }}"
           href="{{ route('public.day', $d) }}">
            {{ $d->day_date->format('d F, Y') }}
        </a>
    @endforeach

    <a class="btn btn-sm btn-outline-primary" href="{{ route('public.home') }}">Total</a>
</div>

{{-- Stats --}}
<div class="card shadow-sm mb-3">
    <div class="card-body text-center">
        <div class="fw-semibold">
            Lofts: {{ $stats['lofts'] }},
            Total pigeons: {{ $stats['total_pigeons'] }},
            Pigeons landed: {{ $stats['landed'] }},
            Pigeons remaining: {{ $stats['remaining'] }}
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle" id="dayTable">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Photo</th>
                        <th>Name</th>

                        @for($i=1;$i<=$pigeonCount;$i++)
                            <th>Pigeon {{ $i }}</th>
                        @endfor

                        <th>Total</th>
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

                            <td>{{ $r->name_ur }}</td>

                            @for($i=1;$i<=$pigeonCount;$i++)
                                <td>{{ $r->cols[$i] ?? '' }}</td>
                            @endfor

                            <td class="fw-bold">{{ $r->total_hms }}</td>
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
    $('#dayTable').DataTable({
      scrollX: true,
      pageLength: 50
    });
  });
</script>
@endpush
