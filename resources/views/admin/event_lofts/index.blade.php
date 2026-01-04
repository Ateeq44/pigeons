@extends('admin.layouts.app')

@section('title', 'Participants')

@section('content')

<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
            <div class="page-header">
                <h2 class="pageheader-title">Participants (Lofts)</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Participants (Lofts)
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.events.participants.attach', $event) }}" class="row g-3 align-items-end">
                @csrf
                <div class="col-md-4">
                    <div>
                        <b>{{ $event->title_ur }}</b>
                        <div>
                            Club: {{ $event->club?->name_ur }}    
                        </div> 
                    </div>
                    <label class="form-label">Select Loft</label>
                    <select name="loft_id" class="form-control" required>
                        <option value="">Choose Loft</option>
                        @foreach($availableLofts as $l)
                        <option value="{{ $l->id }}">{{ $l->name_ur }} {{ $l->city_ur ? ' - '.$l->city_ur : '' }}</option>
                        @endforeach
                    </select>
                    @if($availableLofts->count() === 0)
                    <div class="form-text text-danger">All lofts are already attached.</div>
                    @endif
                </div>

                <div class="col-md-2">
                    <label class="form-label">Pigeons Total (optional)</label>
                    <input type="number" name="pigeons_total" class="form-control" min="1" max="255" placeholder="e.g. 35">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Prize Amount (optional)</label>
                    <input type="number" name="prize_amount" class="form-control" min="0" placeholder="e.g. 150000">
                </div>

                <div class="col-md-2">
                    <label class="form-label">Sort</label>
                    <input type="number" name="sort_order" class="form-control" min="0" value="0">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-success w-100" {{ $availableLofts->count()===0 ? 'disabled' : '' }}>
                        Attach
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Participants (Lofts)</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="participantsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Loft</th>
                                    <th>Pigeons Total</th>
                                    <th>Prize</th>
                                    <th>Sort</th>
                                    <th style="width:140px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participants as $key => $p)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td style="width:70px;">
                                        @if($p->loft?->photo_path)
                                        <img src="{{ asset($p->loft->photo_path) }}" style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                                        @else
                                        <div class="bg-secondary-subtle" style="width:48px;height:48px;border-radius:50%;"></div>
                                        @endif
                                    </td>
                                    <td>{{ $p->loft?->name_ur }} {{ $p->loft?->city_ur ? ' - '.$p->loft->city_ur : '' }}</td>
                                    <td>{{ $p->pigeons_total ?? '—' }}</td>
                                    <td>{{ $p->prize_amount ?? '—' }}</td>
                                    <td>{{ $p->sort_order }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.events.participants.destroy', [$event, $p]) }}"
                                        onsubmit="return confirm('Remove this participant?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
</div>
</div>

@endsection

@push('scripts')
<script>
  $(function(){
    $('#participantsTable').DataTable({ pageLength: 25 });
});
</script>
@endpush
