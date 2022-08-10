<?php

namespace M\Test\Traits;

trait Calc {

    private static $instance = null;

    public static function getInstance(): static
    {
        return self::$instance === null ? self::$instance = new static() : self::$instance;
    }

    protected function getFullSum(): float|int
    {
        $sum = 0;

        foreach ($this->fillable['ordered'] as $product) {
            $sum += $product['price'] * $product['count'];
        }
        return $sum;
    }

    protected function plus($key): void
    {
        $this->fillable['ordered'][$key]['count'] += 1;
    }

    protected function minus($key): void
    {
        $this->fillable['ordered'][$key]['count'] -= 1;
    }
}
