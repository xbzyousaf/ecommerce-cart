<div class="max-w-7xl mx-auto px-4 py-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Products</h1>
        <x-primary-button>
           <a href="{{ route('cart') }}"
           class="inline-flex items-center">
             <i class="fa fa-shopping-cart"></i>
            Cart
            @if($this->cartCount > 0)
                <p>
                    <span
                        class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ $this->cartCount }}
                    </span>
                </p>
            @endif
        </a>
        </x-primary-button>

    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
        @foreach($products as $product)
            <div class="bg-white px-4 py-6 border rounded-lg shadow-lg hover:shadow-md transition flex flex-col">
                <div class="grid grid-cols-2">
                <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $product->name }}
                </h2>

                <p class="text-xl font-bold text-blue-600 mt-2">
                    ${{ $product->price }}
                </p>

                <p class="text-sm text-gray-600 mt-1">
                    Stock:
                    <span class="{{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </p>

                <p class="text-sm text-gray-700 mt-3 line-clamp-3">
                    {{ $product->description }}
                </p>
                </div>
                <div>
                    <img
                        src="{{ asset('images/products/images.JPG') }}"
                        alt="Product image"
                        class="w-full h-40 object-cover rounded-md mb-4"
                    />
                </div>

                </div>

               <x-primary-button
                    wire:click="addToCart({{ $product->id }})"
                    wire:loading.attr="disabled"
                    wire:target="addToCart({{ $product->id }})"
                    :disabled="$product->stock_quantity < 1"
                    class="mt-auto w-full flex items-center justify-center gap-2"
                >
                    {{-- normal state --}}
                    <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                        @if ($product->stock_quantity > 0)
                            <i class="fa fa-plus"></i>
                        @else
                            <i class="fa fa-times"></i>
                        @endif

                        {{ $product->stock_quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                    </span>

                    {{-- loading state --}}
                    <span wire:loading wire:target="addToCart({{ $product->id }})">
                        <i class="fa fa-spinner fa-spin"></i> Adding...
                    </span>
                </x-primary-button>



            </div>
        @endforeach
    </div>
</div>
