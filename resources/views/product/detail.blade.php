<x-app-layout>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            @if ($product->image_path) 
                <img class="max-h-48 mx-auto" src="{{ asset($product->image_path) }}" alt="{{ $product->name }}"> 
            @endif
            <h2 class="mb-2 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">{{ $product->name }}"</h2>
            <p class="mb-4 text-xl font-extrabold leading-none text-gray-900 md:text-2xl dark:text-white">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</dt>
                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $product->description }}</dd>
            </dl>
            <dl class="flex items-center space-x-6">
                <div>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                    <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $product->category->name }}</dd>
                </div>
                <div class="text-center">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Review</dt>
                        <div class="mb-4 flex items-center">
                          <svg class="h-4 w-4 -mt-1 mr-2 mx-auto text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                          </svg>
                          <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $product->star_rating }} ({{ $product->count_rating }})</p>
                        </div>
                </div>
            </dl>
        </div>
    </section>
</x-app-layout>