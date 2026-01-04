@extends('admin.layouts.app')

@section('title', 'Arrivals Entry')

@section('content')

<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
            <div class="page-header">
                <h2 class="pageheader-title">Arrivals Entry</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Arrivals Entry
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="text-muted">
                <b>{{ $event->title_ur }}</b> | Day: {{ $day->day_date->format('Y-m-d') }}
                | Start: {{ \Carbon\Carbon::createFromFormat('H:i:s', $event->start_time)->format('H:i') }}
                | Pigeons: {{ $count }}
            </div>
        </div>

    </div>
    <div class="card shadow-sm mb-3">

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
                    <form method="POST" action="{{ route('admin.arrivals.update', [$event, $day]) }}">
                        @csrf

                        <div class="card shadow-sm">
                            <div class="card-body">

                                @if($participants->count() === 0)
                                <div class="alert alert-warning mb-0">
                                    No participants attached to this event.
                                    Go to <b>Participants</b> and attach lofts first.
                                </div>
                                @else

                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle" id="arrivalsTable">
                                        <thead>
                                            <tr>
                                                <th style="min-width:220px;">Loft</th>
                                                @for($i=1; $i<=$count; $i++)
                                                <th class="text-center">Pigeon {{ $i }}</th>
                                                @endfor
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($participants as $p)
                                            @php
                                            $loft = $p->loft;
                                            $row = $arrivals[$loft->id] ?? collect();
                                            @endphp

                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        @if($loft->photo_path)
                                                        <img src="{{ asset($loft->photo_path) }}"
                                                        style="width:38px;height:38px;border-radius:50%;object-fit:cover;">
                                                        @else
                                                        <div class="bg-secondary-subtle" style="width:38px;height:38px;border-radius:50%;"></div>
                                                        @endif

                                                        <div>
                                                            <div class="fw-semibold">{{ $loft->name_ur }}</div>
                                                            <div class="text-muted small">{{ $loft->city_ur ?? '' }}</div>
                                                        </div>
                                                    </div>
                                                </td>

                                                @for($i=1; $i<=$count; $i++)
                                                @php
                                                $existing = $row->get($i);
                                                $val = $existing?->arrival_time ? \Carbon\Carbon::createFromFormat('H:i:s',$existing->arrival_time)->format('H:i') : '';
                                                @endphp
                                                <td class="text-center">
                                                    <input type="time"
                                                    class="form-control form-control-sm"
                                                    name="times[{{ $loft->id }}][{{ $i }}]"
                                                    value="{{ $val }}">
                                                </td>
                                                @endfor
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <button class="btn btn-success mt-2">Save Arrivals</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end basic table  -->
            <!-- ============================================================== -->
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
  $(function(){
    $('#arrivalsTable').DataTable({
      paging: false,
      searching: true,
      info: false,
      scrollX: true
  });
});
</script>
@endpush
