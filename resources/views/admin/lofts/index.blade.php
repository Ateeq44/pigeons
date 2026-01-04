@extends('admin.layouts.app')

@section('title', 'Lofts')

@section('content')

<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-between align-items-center">
            <div class="page-header">
                <h2 class="pageheader-title">Lofts</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Lofts
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div>    
                <a href="{{ route('admin.lofts.create') }}" class="btn btn-success btn-sm">+ Add Loft</a>
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
                <h5 class="card-header">Lofts</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="loftsTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>Sort</th>
                                    <th style="width:170px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lofts as $key => $l)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td style="width:70px;">
                                        @if($l->photo_path)
                                        <img src="{{ asset($l->photo_path) }}" alt="{{ $l->name_ur }}" style="width:48px;height:48px;object-fit:cover;border-radius:50%;">
                                        @else
                                        <div class="bg-secondary-subtle" style="width:48px;height:48px;border-radius:50%;"></div>
                                        @endif
                                    </td>
                                    <td>{{ $l->name_ur }}</td>
                                    <td>{{ $l->city_ur }}</td>
                                    <td>{{ $l->sort_order }}</td>
                                    <td class="d-flex gap-2">
                                        <a class="btn btn-primary btn-sm mr-2" href="{{ route('admin.lofts.edit', $l) }}">Edit</a>
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
    $('#loftsTable').DataTable({ pageLength: 25 });
});
</script>
@endpush
