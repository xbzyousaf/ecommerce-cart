<?php

namespace App\Services;

use App\Jobs\LowStockJob;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CartService
{
    protected function authUser(): User
    {
        return auth()->user();
    }
    protected function cart(): Cart
    {
        return $this->authUser()->cart
            ?? $this->authUser()->cart()->create();
    }

    public function addProduct(int $productId, int $quantity = 1): void
    {
        $product = Product::whereKey($productId)
            ->where('stock_quantity', '>', 0)
            ->firstOrFail();

        $this->cart()
            ->items()
            ->updateOrCreate(
                ['product_id' => $product->id],
                ['quantity' => DB::raw("quantity + {$quantity}")]
            );
    }

    public function incrementItem(int $itemId): void
    {
        $item = $this->cart()
            ->items()
            ->with('product')
            ->lockForUpdate()
            ->findOrFail($itemId);

        if ($item->quantity >= $item->product->stock_quantity) {
            throw new \RuntimeException(
                "Not enough stock available for {$item->product->name}."
            );
        }

        $item->increment('quantity');
    }

    public function decrementItem(int $itemId): void
    {
        $item = $this->cart()->items()->findOrFail($itemId);

        if ($item->quantity > 1) {
            $item->decrement('quantity');
        }
    }

    public function removeItem(int $itemId): void
    {
        $this->cart()->items()->findOrFail($itemId)->delete();
    }

    public function total(): float
    {
        return $this->cart()
            ->items()
            ->with('product')
            ->get()
            ->sum(fn ($item) => $item->quantity * $item->product->price);
    }

    public function checkout(): Order
    {
        return DB::transaction(function () {
            $cart = $this->cart()->load('items.product');

            if ($cart->items->isEmpty()) {
                throw new \RuntimeException('Your cart is empty.');
            }

            $order = $this->authUser()->orders()->create([
                'total' => $this->total(),
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);

                $item->product->decrement('stock_quantity', $item->quantity);

                if ($item->product->fresh()->stock_quantity <= Product::LOW_STOVCK_THRESHOLD) {
                    LowStockJob::dispatch($item->product);
                }
            }

            $cart->items()->delete();

            return $order;
        });
    }

    public function count(): int
    {
        return $this->cart()
            ->items()
            ->sum('quantity');
    }
}
