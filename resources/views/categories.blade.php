<x-app-layout>
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0 py-10"> 
        <div class="mb-4 flex items-center justify-between gap-4 md:mb-8">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Shop by category</h2>
        </div>
    
        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
          @foreach ($categories as $category)
            <a href="/category/{{ $category->slug }}" class="flex items-center rounded-lg border border-gray-200 bg-white px-4 py-2 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
              <svg class="flex m-3 w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5"/>
              </svg>              
              <span class="font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
            </a>
          @endforeach
        </div>
      </div>
</x-app-layout>
