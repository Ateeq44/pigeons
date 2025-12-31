@extends('admin.layouts.app')

@section('title', 'Lofts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Lofts</h4>
    <a href="{{ route('admin.lofts.create') }}" class="btn btn-success btn-sm">+ Add Loft</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="loftsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>City</th>
                    <th>Sort</th>
                    <th style="width:170px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lofts as $l)
                <tr>
                    <td>{{ $l->id }}</td>
                    <td style="width:70px;">
                        @if($l->photo_path)
                            <img src="{{ asset($l->photo_path) }}" alt="" style="width:48px;height:48px;object-fit:cover;border-radius:50%;">
                        @else
                            <div class="bg-secondary-subtle" style="width:48px;height:48px;border-radius:50%;"></div>
                        @endif
                    </td>
                    <td>{{ $l->name_ur }}</td>
                    <td>{{ $l->city_ur }}</td>
                    <td>{{ $l->sort_order }}</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.lofts.edit', $l) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.lofts.destroy', $l) }}" onsubmit="return confirm('Delete this loft?')">
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
    $('#loftsTable').DataTable({ pageLength: 25 });
  });
</script>
@endpush
