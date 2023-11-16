@aware(['page'])
@props([
    'company_name',
    'heading_image',
    'hero_title',
    'register_button',
    'explore_button',
    'latest_products',
    'requirements',
])

<header>
  <!-- Brand logo Text -->
  <a href="#" class="logo">{{ $company_name }}</a>
  <!-- Navigation bar -->
  <ul class="navbar">
      {{-- redirects to the home --}}
      <li>
          <a href="/home" class="{{ request()->is('home') ? 'active': 'hidden' }}">Home</a>
      </li>
      {{-- redirects to the products --}}
      <li>
          <a href="/products" class="{{ request()->is('products') ? 'active': 'hidden' }}">Products</a>
      </li>
      <li>
          @auth<a href="/application" class="{{ request()->is('application') ? 'active': 'hidden' }}">Application</a>@endauth
      </li>
      {{-- redirects to the about --}}
      <li>
          <a href="/about-us" class="{{ request()->is('about-us') ? 'active': 'hidden' }}">About Us</a>
      </li>
      {{-- redirects to the contact --}}
      <li>
          <a href="/contact-us" class="{{ request()->is('contact-us') ? 'active': 'hidden' }}">Contact Us</a>
      </li>
  </ul>
  <!-- User registration and menu icon -->
  <div class="main">
      <a href="/customer" class="user" id="loginLink">Log In 
          <i class="ri-account-circle-fill"></i>
      </a>
      <div class="ri-menu-line" id="menu-icon"></div>
  </div>
</header>

<section id="Content1">
    <div>
       <!-- Heading Image2 -->
      <img src="{{ config('app.site-images-directory').$heading_image }}" alt="section1-image-bg" />
      <div class="tagline-text">
        <h2>{{ $hero_title }}</h2>
        <div class="buttons">
          {{-- goes to the products section --}}
          <button class="explore-button" onclick="toggleProductSection()">
            {{ $explore_button }}
          </button>
          {{-- goes to the registration form --}}
          <button class="register-button" onclick="window.location.href = '/customer';">
            {{ $register_button }}
          </button>
        </div>
      </div>
    </div>
</section>


<section id="Content3">
  <div class="heading">
    <h1 class="Title"> Introducing the Latest Arrival to Our Motorcycle Lineup! </h1>
  </div>
  <div class="home-product-row"> @foreach ($product_list as $product) 
    <div class="home-product-col">
      <img src="{{ "storage/app/public/".$product->image_file }}" alt="" />
      <h2 class="testi-name">{{ $product->model_name }}</h2>
      <div class="c3-buttons">
        <a href="/products/product-specs/{{$product->id}}">View Full Specs</a>
      </div>
    </div> @endforeach </div>
  <div class="c3-buttons">
    <a href="../html/products.html">See More</a>
  </div>
</section>