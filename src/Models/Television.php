<?php

namespace M\Test\Models;

use M\Test\Models\BaseProduct;

/**
 * Модель Телевизор
 */
class Television extends BaseProduct {

    const CATEGORY = 'television';

    /** Бренд */
    public string $brand;
    /** Диагональ экрана, дюймы */
    public int $diagonal;

    public function __construct(string $name, float $price, string $brand, int $diagonal)
    {
        $category = self::CATEGORY;
        parent::__construct($name, $price, $category);
        $this->brand = $brand;
        $this->diagonal = $diagonal;
    }
}
