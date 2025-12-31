@extends('admin.layouts.app')
@section('title','Settings')

@section('content')
<h4 class="mb-3">Site Settings</h4>

<form method="POST" action="{{ route('admin.settings.update') }}" class="card">
	@csrf
	<div class="card-body">
		<label class="form-label">Tagline / News (Marquee)</label>
		<textarea class="form-control" name="tagline" rows="3">{{ old('tagline',$settings->tagline) }}</textarea>
		<div class="form-text">یہ text site پر چلتی ہوئی نیوز کی طرح show ہوگا۔</div>
		<hr>

		<label class="form-label">Weather Iframe Src (Windy Embed URL)</label>
		<input class="form-control" name="weather_iframe_src"
		value="{{ old('weather_iframe_src', $settings->weather_iframe_src) }}">

		<div class="form-text">
			Windy embed کے iframe کا <b>src</b> یہاں paste کریں۔ Example: https://embed.windy.com/embed2.html?lat=...
		</div>

		<button class="btn btn-success mt-3">Save</button>
	</div>
</form>
@endsection
