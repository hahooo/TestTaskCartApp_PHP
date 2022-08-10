<?php

namespace M\Test\Models;

use M\Test\Models\BaseProduct;

/**
 * Модель Сковорода
 */
class FryingPan extends BaseProduct {

    const CATEGORY = 'frying-pan';

    /** Бренд */
    public string $brand;
    /** Диаметр, см */
    public int $diameter;

    public function __construct(string $name, float $price, string $brand, int $diameter)
    {
        $category = self::CATEGORY;
        parent::__construct($name, $price, $category);
        $this->brand = $brand;
        $this->diameter = $diameter;
    }
}
