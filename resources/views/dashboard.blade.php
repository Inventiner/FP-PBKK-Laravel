<x-app-layout> 
  <div class="mx-auto grid max-w-screen-xl px-4 pt-8 md:grid-cols-12 pb-4 lg:gap-12 lg:pb-8 xl:gap-0">
      <div class="content-center justify-self-start md:col-span-7 md:text-start">
        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight dark:text-white md:max-w-2xl md:text-4xl xl:text-5xl">
          Halo {{ Auth::user()->username }}!
        </h1>
      </div>
      <div class="hidden md:col-span-5 md:mt-0 md:flex">
        {{-- <img class="dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/girl-shopping-list.svg" alt="shopping illustration" /> --}}
        {{-- <img class="hidden dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/girl-shopping-list-dark.svg" alt="shopping illustration" /> --}}
      </div>
  </div>

  <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
      <!-- Dashboard Products -->
      @forelse ($products as $product) 
        <div class=" max-h-fit rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
          <!-- Product's Photo -->
          <div class="h-56 w-full">
            <a href="/store/{{ $product->slug }}">
              <img class="mx-auto h-full object-contain" src={{ $product->image_path }} alt="" />
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
            <div class="flex items-end down place-content-evenly flex-row justify-between"> 
              <div class="flex self-center"> 
                <p class="text-lg font-extrabold leading-tight text-gray-900 dark:text-white">
                  Rp{{ number_format($product->price, 0, ',', '.') }}
                </p> 
              </div>
              <div>
                <a href="/dashboard/edit/{{ $product->slug }}">
                  <button type="button" class="inline-flex items-center rounded-lg bg-primary-700 px-4 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                    </svg>
                    Edit Product
                  </button>
                </a>
              </div>
            </div> 
          </div>
        </div>
      @empty
      @endforelse

      <!-- Add new Products -->
      <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        
      <!-- Button -->
      <a href="/dashboard/upload">
        <div class="flex items-center justify-center w-full">
          <button class="w-full flex flex-col items-center justify-center border-2 min-h-[25rem] border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500" type="button">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
              <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
              </svg>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload new Products</p>
            </div>
          </button>
        </div>
      </a>
  
</x-app-layout>


