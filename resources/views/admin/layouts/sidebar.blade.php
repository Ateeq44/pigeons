@php
$route = request()->route()?->getName();
@endphp

<div class="nav-left-sidebar sidebar-dark">
  <div class="menu-list">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
          <li class="nav-divider"></li>
          <li class="nav-item ">
            <a class="nav-link {{ $route === 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
              <i class="fa-solid fa-gauge"></i>
              Dashboard 
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link  {{ str_starts_with($route ?? '', 'admin.clubs.') ? 'active' : '' }} {{ Route::has('admin.clubs.index') ? '' : 'disabled' }}"
            href="{{ Route::has('admin.clubs.index') ? route('admin.clubs.index') : '#' }}">
            <i class="fa-solid fa-circle-nodes"></i>
            Clubs 
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link  {{ str_starts_with($route ?? '', 'admin.events.') ? 'active' : '' }} {{ Route::has('admin.events.index') ? '' : 'disabled' }}"
          href="{{ Route::has('admin.events.index') ? route('admin.events.index') : '#' }}">
          <i class="fa-solid fa-calendar"></i>
          Events
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link  {{ str_starts_with($route ?? '', 'admin.lofts.') ? 'active' : '' }} {{ Route::has('admin.lofts.index') ? '' : 'disabled' }}"
        href="{{ Route::has('admin.lofts.index') ? route('admin.lofts.index') : '#' }}">
        <i class="fa-solid fa-left-right"></i>
        Lofts
      </a>
    </li>

    <li class="nav-item ">
      <a class="nav-link {{ str_starts_with($route ?? '', 'admin.sliders.') ? 'active' : '' }}
      {{ Route::has('admin.sliders.index') ? '' : 'disabled' }}"
      href="{{ Route::has('admin.sliders.index') ? route('admin.sliders.index') : '#' }}">
      <i class="fa-solid fa-sliders"></i>
      Sliders
    </a>
  </li>

  <li class="nav-item ">
    <a class="nav-link {{ str_starts_with($route ?? '', 'admin.settings.') ? 'active' : '' }} {{ Route::has('admin.settings.edit') ? '' : 'disabled' }}" href="{{ Route::has('admin.settings.edit') ? route('admin.settings.edit') : '#' }}">
      <i class="fa-solid fa-gear"></i>
      Settings
    </a>
  </li>

</ul>
</div>
</nav>
</div>
</div>