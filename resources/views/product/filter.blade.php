<x-app-layout>
  <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-12">
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <!-- Heading & Filters -->
        <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
          <!-- Navigation (home -> products -> electronics) -->
          <div>
            <nav class="flex" aria-label="Breadcrumb">
              <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                  <a href="/store" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="me-2.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                      <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Home
                  </a>
                </li>
                <li>
                  <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                    <a href="/categories" class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2">Products</a>
                  </div>
                </li>
                <li aria-current="page">
                  <div class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">{{ $category }}</span>
                  </div>
                </li>
              </ol>
            </nav>
            <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ $category }}</h2>
          </div>
        </div>

        <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
          <!-- Store Products -->
          @forelse ($products as $product) 
          <div class="max-h-fit rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <!-- Product's Photo -->
            <div class="h-56 w-full">
              <a href="/store/{{ $product->slug }}">
                <img class="mx-auto h-full object-contain" src="{{ asset($product->image_path) }}" alt="" />
              </a>
            </div>

              <!-- Product's Description -->
              <div class="h-44 pt-3">
                <div class="mb-2 flex items-center justify-between gap-4">
                  <a href="/category/{{ $product->category->slug }}">
                    <span class="me-2 hover:underline rounded bg-{{ $product->category->color }}-200 px-2.5 py-0.5 text-xs font-bold text-black-800 dark:bg-primary-900 dark:text-primary-300">
                      {{ $product->category->name }} 
                    </span>
                  </a>
                  
                  <div class="flex items-center justify-end gap-1">
                    <button type="button" data-tooltip-target="tooltip-add-to-favorites" class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                      <span class="sr-only"> Add to Favorites </span>
                      <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                      </svg>
                    </button>
                    <div id="tooltip-add-to-favorites" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700" data-popper-placement="top">
                      Add to favorites
                      <div class="tooltip-arrow" data-popper-arrow=""></div>
                    </div>
                  </div>
                </div>

              <div class="h-12">
                <a href="/store/{{ $product->slug }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">
                  {{ $product->name }}
                </a>
              </div>
                
              <!-- Rating -->
            <div class="mt-2 flex items-center gap-2">
              <div class="-mt-1 flex items-center">
                <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                </svg>
              </div>
              
              <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->star_rating }}</p>
              <p class="text-sm font-medium text-gray-500 dark:text-gray-400">({{ $product->count_rating }})</p>
            </div>
              
              <!-- Price & Add To Cart -->
              <div class="flex flex-row items-end justify-between"> 
                <div class="flex self-center"> 
                  <p class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                  </p> 
                </div>
                <div>
                  <button type="button" class="add-to-cart inline-flex items-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                      data-product-id="{{ $product->id }}" 
                      data-product-price="{{ $product->price }}"
                    >
                      <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                      </svg>
                      Add to cart
                    </button>
                  {{-- <!-- <button type="button" class="inline-flex items-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                    </svg>
                    Add to cart
                  </button> --> --}}
                </div>
              </div>  
            </div>
          </div>
          @empty
          <h1> Placeholder No Product Found! </h1>
          @endforelse
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script>
      $(document).on('click', '.add-to-cart', function() {
        var productId = $(this).data('product-id');
        var price = $(this).data('product-price');
        var quantity = 1; 

        $.ajax({
          url: "{{ route('cart.add') }}",  
          method: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            product_id: productId,
            price: price,
            quantity: quantity
          },
          success: function(response) {
          
            $.ajax({
                type: "GET",
                url: "/update-cart-navbar",  
                success: function(data) {
                    $('#cart-navbar').html(data);  
                    
              
                    const cartDropdownButton = document.querySelector('#myCartDropdownButton1');
                    const cartDropdown = document.querySelector('#myCartDropdown1');
                    
                    if (cartDropdownButton && cartDropdown) {
                        new Dropdown(cartDropdown, cartDropdownButton);  
                    }
                }
            });
          },
          error: function(xhr, status, error) {
            
              console.log(xhr.responseText);
              console.log(status);
              console.log(error);
              alert("Something went wrong: " + xhr.responseText); 
          }
        });
      });
    </script>
    </section>
</x-app-layout>