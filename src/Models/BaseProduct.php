<?php

namespace M\Test\Models;

use M\Test\Database\Model;

/**
 * Базовая Модель Продукт
 */
class BaseProduct extends Model
{
    /** Наименование */
    public string $name;
    /** Цена */
    public float $price;
    /** Категория (тип продукта) */
    public string $category;

    public function __construct(string $name, float $price, string $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }
}
