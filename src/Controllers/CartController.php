<?php

namespace M\Test\Controllers;

use M\Test\Classes\Cart;
use M\Test\Controllers\Controller;
use M\Test\Models\BaseProduct;

class CartController extends Controller
{

    public function cart()
    {
         return (new Cart())->getOrder();
    }

     public function CartAdd(BaseProduct $product)
     {
         $result = (new Cart(true))->addProduct($product);

         if ($result) {
             echo 'Продукт ' . $product->name . ' успешно добавлен в заказ!';
         } else {
             echo 'Ошибка добавления продукта: ' . $product->name;
         }
     }

     public function CartRemove(BaseProduct $product)
     {
         (new Cart())->removeProduct($product);

         echo 'Продукт ' . $product->name . ' успешно удалён из заказа!';
     }
}