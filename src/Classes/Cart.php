<?php

namespace M\Test\Classes;

use M\Test\Models\BaseProduct;
use M\Test\Models\Order;

class Cart
{
    protected mixed $order;

    /**
     * Cart constructor.
     * @param bool $createOrder
     */
    public function __construct(bool $createOrder = false)
    {
        if (!isset($_SESSION['order']) && $createOrder) {
            $user_id = 1;
            $this->order = new Order($user_id);
            $_SESSION['order'] = $this->order;
        } else {
            $this->order = $_SESSION['order'];
        }
    }

    /**
     * @return mixed
     */
    public function getOrder(): mixed
    {
        return $this->order;
    }

     public function removeProduct(BaseProduct $product): void
     {
         if ($this->getOrder()->contains($product)) {
             $this->getOrder()->delete($product);
         }
     }

     public function addProduct(BaseProduct $product): bool
     {
         if ($this->getOrder()->contains($product)) {
             $this->getOrder()->add($product);
         } else {
             $this->getOrder()->push($product);
         }

         return true;
     }
}