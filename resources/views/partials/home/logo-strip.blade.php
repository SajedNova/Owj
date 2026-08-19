<section class="logo-strip">

  <div class="logo-strip__marquee">
    <div class="logo-strip__track" id="track">
      @foreach($brands as $brand)
        <div class="logo-strip__logo"><img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"></div>
      @endforeach
      @foreach($brands as $brand)
        <div class="logo-strip__logo"><img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"></div>
      @endforeach
    </div>
  </div>
</section>
