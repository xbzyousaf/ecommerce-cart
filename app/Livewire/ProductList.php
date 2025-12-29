<?php

namespace App\Livewire;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]

class ProductList extends Component
{
    protected CartService $cartService;

    public function boot(CartService $cartService): void
    {
        $this->cartService = $cartService;
    }

    public function addToCart(int $productId): void
    {
        $this->cartService->addProduct($productId);
    }

    public function getCartCountProperty(): int
    {
        return $this->cartService->count();
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => Product::all(),
        ]);
    }
}

