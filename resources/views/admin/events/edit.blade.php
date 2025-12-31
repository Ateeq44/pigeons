@extends('admin.layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Edit Event</h4>
    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.events.update', $event) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Club</label>
                <select name="club_id" class="form-select" required>
                    @foreach($clubs as $c)
                        <option value="{{ $c->id }}" @selected(old('club_id',$event->club_id)==$c->id)>{{ $c->name_ur }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Title (Urdu)</label>
                <input type="text" name="title_ur" class="form-control" value="{{ old('title_ur',$event->title_ur) }}" required>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Start Time</label>
                    <input type="time" name="start_time" class="form-control"
                           value="{{ old('start_time', \Carbon\Carbon::createFromFormat('H:i:s',$event->start_time)->format('H:i')) }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ old('start_date',$event->start_date->format('Y-m-d')) }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date',$event->end_date->format('Y-m-d')) }}" required>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-4">
                    <label class="form-label">Pigeons Per Loft (1-10)</label>
                    <select name="pigeons_per_loft" class="form-select" required>
                        @for($i=1;$i<=10;$i++)
                            <option value="{{ $i }}" @selected(old('pigeons_per_loft',$event->pigeons_per_loft)==$i)>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured" @checked(old('is_featured',$event->is_featured))>
                        <label class="form-check-label" for="is_featured">Featured on Home</label>
                    </div>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order',$event->sort_order) }}" min="0">
                </div>
            </div>

            <button class="btn btn-success mt-3">Update</button>
        </form>
    </div>
</div>
@endsection
