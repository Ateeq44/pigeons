@extends('admin.layouts.app')

@section('title', 'Clubs')

@section('content')

<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
            <div class="page-header">
                <h2 class="pageheader-title">Clubs</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Clubs
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div>    
                <a href="{{ route('admin.clubs.create') }}" class="btn btn-success btn-sm">+ Add Club</a>
            </div>
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
                <h5 class="card-header">Clubs</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first" id="clubsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name (Urdu)</th>
                                    <th>Featured</th>
                                    <th>Sort</th>
                                    <th style="width:160px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clubs as $key => $c)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $c->name_ur }}</td>
                                    <td>{!! $c->is_featured ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}</td>
                                    <td>{{ $c->sort_order }}</td>
                                    <td class="d-flex gap-2">
                                        <a class="btn btn-primary btn-sm mr-2" href="{{ route('admin.clubs.edit', $c) }}">Edit</a>

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
    $('#clubsTable').DataTable({
      pageLength: 25
  });
});
</script>
@endpush
