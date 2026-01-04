@extends('admin.layouts.app')
@section('title','Settings')

@section('content')

<div class="row">
	<div class="col-xl-12">
		<!-- ============================================================== -->
		<!-- pageheader  -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="page-header" id="top">
					<h2 class="pageheader-title">Site Settings</h2>
					<div class="page-breadcrumb">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}" class="breadcrumb-link">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Site Settings</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- end pageheader  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- basic form  -->
<!-- ============================================================== -->
<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
		<div class="card">
			<h5 class="card-header">Site Settings</h5>
			<div class="card-body">
				<form method="POST" action="{{ route('admin.settings.update') }}" class="card">
					@csrf
					<div class="card-body">
						<label class="form-label">Tagline / News (Marquee)</label>
						<textarea class="form-control" name="tagline" rows="3">{{ old('tagline',$settings->tagline) }}</textarea>
						<hr>

						<label class="form-label">Weather Iframe Src (Windy Embed URL)</label>
						<input class="form-control" name="weather_iframe_src"
						value="{{ old('weather_iframe_src', $settings->weather_iframe_src) }}">

						<button class="btn btn-success mt-3">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>

@endsection
