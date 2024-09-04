<?php

namespace App\Services;

use App\Enums\CartPositionEnums;
use App\Enums\FileableFileTypeEnum;
use App\Exceptions\AppException;
use App\Exceptions\TranslatedException;
use App\Models\Cart;
use App\Models\CartPosition;
use App\Models\Display;
use App\Models\DisplayType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartService
{
    private ?Cart $cart;
    private ?User $user;

    public function __construct($forcedUser = null, ?Cart $forcedCart = null)
    {
        if (!$forcedUser && !auth()->check()) {
            //throw new TranslatedException('cart.general.exceptions.cannot_use_cart_service_without_auth_user');
        }

        $this->user = $forcedUser ?? auth()->user();
        $this->cart = $forcedCart ?? $this->getAuthUserCart();
        $this->cart->load('cartPositions');
    }

    public function getAuthUserCart(): Cart
    {
        if (!empty($this->cart)) {
            return $this->cart;
        }

        if (!empty($cart = $this->user->cart?->refresh())) {
            return $cart;
        }

        return $this->cart = Cart::query()->create([
            'user_id' => $this->user->id,
        ]);
    }

    public function addNewPosition( int $quantity, ?string $comment = null): CartPosition
    {
        /** @var CartPosition $position */
        $position = $this->cart->cartPositions()
            ->create([
                'position' => 0,
                'quantity' => $quantity,
                'comment' => $comment,
            ]);

        $this->cart->refresh();

        return $position;
    }

    public function processPositionStoreRequest(array $data): CartPosition
    {
        return $this->addNewPosition($data['quantity'], $data['comment'] ?? null);
    }

}
