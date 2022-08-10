<?php

namespace M\Test\Models;

use M\Test\Models\BaseProduct;

/**
 * Модель Смартфон
 */
class Smartphone extends BaseProduct {

    const CATEGORY = 'smartphone';

    /** Бренд */
    public string $brand;
    /** Диагональ экрана, дюймы */
    public float $diagonal;

    public function __construct(string $name, float $price, string $brand, float $diagonal)
    {
        $category = self::CATEGORY;
        parent::__construct($name, $price, $category);
        $this->brand = $brand;
        $this->diagonal = $diagonal;
    }
}
