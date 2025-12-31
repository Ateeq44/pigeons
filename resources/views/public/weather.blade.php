@extends('layouts.public')

@section('title', 'Weather')

@section('content')
<div class="card shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Weather</h5>

    <div class="ratio ratio-16x9">
      <iframe src="{{ $weatherSrc }}" frameborder="0" allowfullscreen loading="lazy"></iframe>
    </div>
  </div>
</div>
@endsection
