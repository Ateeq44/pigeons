@extends('admin.layouts.app')

@section('title', 'Participants')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Participants (Lofts)</h4>
        <div class="text-muted">
            <b>{{ $event->title_ur }}</b> — Club: {{ $event->club?->name_ur }}
        </div>
    </div>

    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.participants.attach', $event) }}" class="row g-3 align-items-end">
            @csrf

            <div class="col-md-4">
                <label class="form-label">Select Loft</label>
                <select name="loft_id" class="form-select" required>
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

<div class="card shadow-sm">
    <div class="card-body">
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
                @foreach($participants as $i => $p)
                <tr>
                    <td>{{ $i+1 }}</td>
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
@endsection

@push('scripts')
<script>
  $(function(){
    $('#participantsTable').DataTable({ pageLength: 25 });
  });
</script>
@endpush
