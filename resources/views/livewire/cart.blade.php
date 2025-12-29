<div class="max-w-7xl mx-auto px-4 py-6 bg-white rounded-md shadow-md mt-4">
    @if (session()->has('error'))
    <div class="bg-red-100 text-red-700 p-2 mb-3">
        {{ session('error') }}
    </div>
    @endif

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-700 p-2 mb-3">
        {{ session('success') }}
    </div>
    @endif

    @if($cart && $cart->items->count())
    <div class="flex justify-between border-b py-2 bg-gray-100 p-2">
        <span class="font-medium">Product</span>
        <span class="font-medium">Quantity</span>
        <span class="font-medium">Remove </span>
        <span class="font-medium">Price</span>
    </div>
    @foreach($cart->items as $item)
    <div class="flex justify-between border-b py-2 p-2">
        <span>{{ $item->product->name }}</span>

        <div class="flex items-center justify-between w-28">
            <x-primary-button wire:click="decrement({{ $item->id }})">
                <i class="fa fa-minus"></i>
            </x-primary-button>

            <span class="font-medium text-left gap-2 px-3">
                {{ $item->quantity }}
            </span>

            <x-primary-button wire:click="increment({{ $item->id }})">
                <i class="fa fa-plus"></i>
            </x-primary-button>
        </div>

        <x-danger-button title="Remove" wire:click="remove({{ $item->id }})" class="text-red-500 hover:text-red-700">
            <i class="fa fa-times"></i>
        </x-danger-button>
        <div class="font-medium">
            ${{ number_format($item->quantity * $item->product->price, 2) }}
        </div>

    </div>
    @endforeach
    <div class="flex justify-end font-bold mt-4">
        Total: ${{ number_format($this->total, 2) }}
    </div>
    <div class="flex justify-end font-bold">
        <x-primary-button wire:click="checkout" class="bg-green-500 text-black px-4 py-2 mt-4 rounded-md shadow-md hover:bg-green-600 flex items-center gap-2">
            <i class="fa fa-check"></i>
            Checkout
        </x-primary-button>
    </div>
   @else
        @if(!session()->has('success'))
            <p>Your cart is empty.</p>
        @endif
    @endif

</div>
