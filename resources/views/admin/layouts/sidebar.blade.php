@php
  $route = request()->route()?->getName();
@endphp

<div class="list-group">
  <a class="list-group-item list-group-item-action {{ $route === 'admin.dashboard' ? 'active' : '' }}"
     href="{{ route('admin.dashboard') }}">
    Dashboard
  </a>

  <a class="list-group-item list-group-item-action {{ str_starts_with($route ?? '', 'admin.clubs.') ? 'active' : '' }} {{ Route::has('admin.clubs.index') ? '' : 'disabled' }}"
     href="{{ Route::has('admin.clubs.index') ? route('admin.clubs.index') : '#' }}">
    Clubs
  </a>

  <a class="list-group-item list-group-item-action {{ str_starts_with($route ?? '', 'admin.events.') ? 'active' : '' }} {{ Route::has('admin.events.index') ? '' : 'disabled' }}"
     href="{{ Route::has('admin.events.index') ? route('admin.events.index') : '#' }}">
    Events
  </a>

  <a class="list-group-item list-group-item-action {{ str_starts_with($route ?? '', 'admin.lofts.') ? 'active' : '' }} {{ Route::has('admin.lofts.index') ? '' : 'disabled' }}"
     href="{{ Route::has('admin.lofts.index') ? route('admin.lofts.index') : '#' }}">
    Lofts
  </a>

  <a class="list-group-item list-group-item-action
          {{ str_starts_with($route ?? '', 'admin.sliders.') ? 'active' : '' }}
          {{ Route::has('admin.sliders.index') ? '' : 'disabled' }}"
   href="{{ Route::has('admin.sliders.index') ? route('admin.sliders.index') : '#' }}">
   Sliders
</a>
<a class="list-group-item list-group-item-action
          {{ str_starts_with($route ?? '', 'admin.settings.') ? 'active' : '' }}
          {{ Route::has('admin.settings.edit') ? '' : 'disabled' }}"
   href="{{ Route::has('admin.settings.edit') ? route('admin.settings.edit') : '#' }}">
   Settings
</a>

</div>
