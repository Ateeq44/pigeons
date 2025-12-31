@extends('admin.layouts.app')

@section('title', 'Clubs')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Clubs</h4>
    <a href="{{ route('admin.clubs.create') }}" class="btn btn-success btn-sm">+ Add Club</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped" id="clubsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name (Urdu)</th>
                    <th>Slug</th>
                    <th>Sort</th>
                    <th style="width:160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clubs as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name_ur }}</td>
                    <td>{{ $c->slug }}</td>
                    <td>{{ $c->sort_order }}</td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.clubs.edit', $c) }}">Edit</a>

                        <form method="POST" action="{{ route('admin.clubs.destroy', $c) }}"
                              onsubmit="return confirm('Delete this club?')">
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
    $('#clubsTable').DataTable({
      pageLength: 25
    });
  });
</script>
@endpush
