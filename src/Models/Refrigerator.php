<?php

namespace M\Test\Models;

use M\Test\Models\BaseProduct;

/**
 * Модель Холодильник
 */
class Refrigerator extends BaseProduct {

    const CATEGORY = 'refrigerator';

    /** Бренд */
    public string $brand;
    /** Объем холодильной камеры, л */
    public int $volume;

    public function __construct(string $name, float $price, string $brand, int $volume)
    {
        $category = self::CATEGORY;
        parent::__construct($name, $price, $category);
        $this->brand = $brand;
        $this->volume = $volume;
    }
}