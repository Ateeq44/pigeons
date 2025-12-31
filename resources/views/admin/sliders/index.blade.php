@extends('admin.layouts.app')
@section('title','Sliders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h4 class="mb-0">Sliders</h4>
  <a href="{{ route('admin.sliders.create') }}" class="btn btn-success btn-sm">Add Slider</a>
</div>

<div class="card">
  <div class="card-body">
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>#</th><th>Image</th><th>Title</th><th>Active</th><th>Sort</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sliders as $i => $s)
        <tr>
          <td>{{ $i+1 }}</td>
          <td style="width:120px;">
            <img src="{{ asset($s->image_path) }}" style="width:110px;height:55px;object-fit:cover;border-radius:8px;">
          </td>
          <td>{{ $s->title ?? '—' }}</td>
          <td>{{ $s->is_active ? 'Yes' : 'No' }}</td>
          <td>{{ $s->sort_order }}</td>
          <td class="d-flex gap-2">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.sliders.edit',$s) }}">Edit</a>
            <form method="POST" action="{{ route('admin.sliders.destroy',$s) }}" onsubmit="return confirm('Delete?')">
              @csrf @method('DELETE')
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
