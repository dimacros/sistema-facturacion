<div class="row">
    <div class="{{ isset($class) ? $class : 'col-md-12' }}">
      <div class="tile">
        <div class="tile-body">
            {{ $slot }}
        </div>
      </div>
    </div>
</div>