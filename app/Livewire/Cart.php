<?php

namespace App\Livewire;

use App\Services\CartService;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.app')]
class Cart extends Component
{
    protected CartService $cartService;
    public function boot(CartService $cartService): void
    {
        $this->cartService = $cartService;
    }
    public function increment($itemId)
    {
        try {
            $this->cartService->incrementItem($itemId);
        } catch (\RuntimeException $e) {
            session()->flash('error', $e->getMessage());
        }
    }


    public function decrement($itemId)
    {
        try {
            $this->cartService->decrementItem($itemId);
        } catch (\RuntimeException $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function remove($itemId)
    {
        try {
            $this->cartService->removeItem($itemId);
        } catch (\RuntimeException $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function checkout()
    {
        try {
            $this->cartService->checkout();
            session()->flash('success', 'Order placed successfully!');
        } catch (\RuntimeException $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    public function getTotalProperty()
    {
        try {
            return $this->cartService->total();
        } catch (\RuntimeException $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.cart', [
            'cart' => auth()->user()
                ->cart()
                ->with('items.product')
                ->first(),
        ]);
    }
}
