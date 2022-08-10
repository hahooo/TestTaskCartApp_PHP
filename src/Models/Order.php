<?php

namespace M\Test\Models;

use M\Test\Database\Model;
use M\Test\Models\BaseProduct;
use M\Test\Traits\Calc;

class Order extends Model
{
    use Calc;

    protected array $fillable = [];

    public function __construct($user_id)
    {
        $this->fillable = array('user_id' => $user_id, 'sum' => 0);
    }

     public function contains(BaseProduct $product): bool
     {
         if (isset($this->fillable['ordered'])) {
             $names = array_column($this->fillable['ordered'], 'name');
             return in_array($product->name, $names);
         }
         return false;
     }

    public function getKeyProduct(BaseProduct $product): bool|int|string
    {
        return array_search($product->name, array_column($this->fillable['ordered'], 'name'));
    }

    public function push(BaseProduct $product)
    {
        if (!isset($this->fillable['ordered'])) $this->fillable['ordered'] = [];
        array_push($this->fillable['ordered'], array('count' => 1, 'price' => $product->price, 'name' => $product->name));
        $this->fillable['sum'] = $this->getFullSum();
    }

    public function add(BaseProduct $product)
    {
        $key = $this->getKeyProduct($product);
        $this->plus($key);
        $this->fillable['sum'] = $this->getFullSum();
    }

    public function delete(BaseProduct $product)
    {
        $key = $this->getKeyProduct($product);
        if ($this->fillable['ordered'][$key]['count'] > 1) {
            $this->minus($key);
        } else {
            unset($this->fillable['ordered'][$key]);
        }
        $this->fillable['ordered'] = array_values($this->fillable['ordered']);
        $this->fillable['sum'] = $this->getFullSum();
    }
}