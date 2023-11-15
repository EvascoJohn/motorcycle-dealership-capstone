@aware(['page'])
@props([
    'heading_image',
    'hero_title',
    'register_button',
    'explore_button',
    'latest_products',
    'requirements',
])

<section id="Content1">
    <div>
       <!-- Heading Image -->
      <img src="{{ "storage/".$heading_image) }}" alt="section1-image-bg" />
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