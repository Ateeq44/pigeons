@php
  $sliders = $globalSliders ?? collect();
  $featuredClubs = $globalFeaturedClubs ?? collect();
  $featuredEvents = $globalFeaturedEvents ?? collect();
  $tagline = $globalTagline ?? '';
@endphp

{{-- 1) Slider --}}
@if($sliders->count())
<div id="topCarousel" class="carousel slide mb-0" data-bs-ride="carousel">
  <div class="carousel-inner">
    @foreach($sliders as $k => $s)
      <div class="carousel-item {{ $k===0 ? 'active' : '' }}">
        @if($s->link_url)
          <a href="{{ $s->link_url }}">
            <img src="{{ asset($s->image_path) }}" class="d-block w-100" style="height:340px;object-fit:cover;">
          </a>
        @else
          <img src="{{ asset($s->image_path) }}" class="d-block w-100" style="height:340px;object-fit:cover;">
        @endif
      </div>
    @endforeach
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#topCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#topCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>
@endif

{{-- 2) Featured clubs green strip --}}
@if($featuredClubs->count())
<div class="py-3" style="background:#3f51b5;">
  <div class="container">
    <div class="d-flex gap-4 flex-wrap align-items-center">
      <a class="text-white fw-bold text-decoration-none" href="{{ route('public.home') }}">Home</a>
      <a class="text-white text-decoration-none" href="{{ route('public.weather') }}">Weather</a>
      @foreach($featuredClubs as $c)
        <a class="text-white text-decoration-none" href="{{ route('public.clubs.show',$c) }}">
          {{ $c->name_ur }}
        </a>
      @endforeach
    </div>
  </div>
</div>
@endif


{{-- 3) Tagline marquee white strip --}}
@if($tagline)
<div class="bg-white border-bottom">
  <div class="container py-3">
    <div class="marquee">
      <div class="marquee__inner">
        <span style="color: #3f51b5;">{{ $tagline }}</span>
      </div>
    </div>
  </div>
</div>
@endif

{{-- 4) Featured events blue strip --}}
@if($featuredEvents->count())
<div class="py-3" style="background:#3f51b5;">
  <div class="container">
    <div class="d-flex gap-3 flex-wrap">
      @foreach($featuredEvents as $e)
        <a class="text-white text-decoration-none fw-semibold"
           href="{{ route('public.event',$e) }}">
          {{ $e->title_ur }}
        </a>
      @endforeach
    </div>
  </div>
</div>
@endif
