<?php

//PHP
//
//1. Реализовать структуру классов для модели приложения "Корзина товаров". Для примера взять 3 типа товара(с предположением, что кол-во типов товара может измениться):
//	1) Телевизор, характеристика: цена, бренд, диагональ.
//2) Телефон, характеристика: цена, бренд, диагональ.
//3) Сковородка, характеристика: цена, бренд, диаметр.
//
//
//2. Должен быть реализован класс Калькулятор для подсчета стоимости всей корзины, можно добавлять любое кол-во товаров, например:
//15 телевизоров, 2 телефона, 3 сковородки
//
//Условия:
//1) Использовать наследование, код делать максимально гибким к изменениям
//2) Класс калькулятор должен реализовывать паттерн - singleton
//3) Класс-калькулятор должен гарантировать что в коллекции товаров(над которыми будет производиться расчет), каждый товар должен иметь цену и бренд.
//4) Не должно быть дублирования кода.
//5) Архитектура, код должны позволять манипулировать списоком типов товара, без изменений в коде класса-калькулятора или его родительских классов
//6) Архитектура, код должны позволять манипулировать характеристиками типов товара и правилами их валидации, без изменений в коде класса-калькулятора или его родительских классов
//7. Должны быть написано 2 unit теста для проверки успешного сценария (см. пример расчета).
//
//
//Пример расчета:
//10 телевизоров по цене 50000, 2 телефона по цене 10000, 3 сковородки по цене 2000


// 29999,Телевизор Toshiba 43C350KE,43"
// 44999,Телевизор Toshiba 55U5069,55"
// 32999,Телевизор Novex NVX-55U321MSY,55"
// 31999,Телевизор Hisense 50A6BG,50"
//
// 15999,Смартфон HUAWEI nova Y70 Midnight Black (MGA-LX9N),6.75"
// 120999,Смартфон Apple iPhone 13 Pro Max 128GB Alpine Green,6.7"
// 80999,Смартфон Apple iPhone 13 128GB Blue,6.1"
// 15999,Смартфон HUAWEI nova Y70 Crystal Blue (MGA-LX9N),6.75"
// 80999,Смартфон Apple iPhone 13 128GB Midnight,6.1"
//
// 1199,Сковорода Tefal Simply Clean (04205126),26 см
// 999,Сковорода Inhouse RUBY (IHRB28),28 см
// 299,Сковорода Hitt Frypan (HF2018-24),24 см
// 1799,Сковорода Rondell Lumier RDA-592,20 см
//
// 42999,Холодильник Candy CCRN 6180W,Объем холодильной камеры 227 л
// 43999,Холодильник Gorenje NRK6191PW4,Объем холодильной камеры 96 л
// 35499,Холодильник Atlant ХМ 6024-031,Объем холодильной камеры 246 л
// 47999,Холодильник Haier CEF535AWG,Объем холодильной камеры 241 л

error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../vendor/autoload.php';
session_start();

// Массив категорий (типов) продуктов
$objectsNameArray = ['television', 'smartphone', 'fryingPan', 'refrigerator'];

echo '1. Создаем экземпляры телевизоров<br><br>';
$television1 = new \M\Test\Models\Television('Телевизор Toshiba 43C350KE', 29999,'Toshiba', 43);
$television2 = new \M\Test\Models\Television('Телевизор Toshiba 55U5069', 44999,'Toshiba', 55);
$television3 = new \M\Test\Models\Television('Телевизор Novex NVX-55U321MSY', 32999,'Novex', 55);
$television4 = new \M\Test\Models\Television('Телевизор Hisense 50A6BG', 31999,'Hisense', 50);

echo '2. Создаем экземпляры смартфонов<br><br>';
$smartphone1 = new \M\Test\Models\Smartphone('Смартфон HUAWEI nova Y70 Midnight Black (MGA-LX9N)', 15999,'HUAWEI', 6.75);
$smartphone2 = new \M\Test\Models\Smartphone('Смартфон Apple iPhone 13 Pro Max 128GB Alpine Green', 120999,'Apple', 6.7);
$smartphone3 = new \M\Test\Models\Smartphone('Смартфон Apple iPhone 13 128GB Blue', 80999,'Apple', 6.1);
$smartphone4 = new \M\Test\Models\Smartphone('Смартфон HUAWEI nova Y70 Crystal Blue (MGA-LX9N)', 15999,'HUAWEI', 6.75);

echo '3. Создаем экземпляры сковородок<br><br>';
$fryingPan1 = new \M\Test\Models\FryingPan('Сковорода Tefal Simply Clean (04205126)', 1199,'Tefal', 26);
$fryingPan2 = new \M\Test\Models\FryingPan('Сковорода Inhouse RUBY (IHRB28)', 999,'Inhouse', 28);
$fryingPan3 = new \M\Test\Models\FryingPan('Сковорода Hitt Frypan (HF2018-24)', 299,'Hitt', 24);
$fryingPan4 = new \M\Test\Models\FryingPan('Сковорода Rondell Lumier RDA-592', 1799,'Rondell', 20);

echo '4. Создаем экземпляры холодильников<br><br>';
$refrigerator1 = new \M\Test\Models\Refrigerator('Холодильник Candy CCRN 6180W', 42999,'Candy', 227);
$refrigerator2 = new \M\Test\Models\Refrigerator('Холодильник Gorenje NRK6191PW4', 43999,'Gorenje', 96);
$refrigerator3 = new \M\Test\Models\Refrigerator('Холодильник Atlant ХМ 6024-031', 35499,'Atlant', 246);
$refrigerator4 = new \M\Test\Models\Refrigerator('Холодильник Haier CEF535AWG', 47999,'Haier', 241);

echo 'Смотрим результат:<br><br>';
foreach ($objectsNameArray as $objectName) {
    foreach (range(1, 4) as $number) {
        $varName = $objectName . $number;
        $string = serialize($$varName);
        echo $varName . ': ' . $string . '<br>';
    }
    echo '<br><br>';
}


$cartController = new M\Test\Controllers\CartController;

echo 'Добавляем в корзину ' . $refrigerator4->name . '<br><br>';
$cartController->CartAdd($refrigerator4);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ещё ' . $refrigerator4->name . '<br><br>';
$cartController->CartAdd($refrigerator4);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ' . $television3->name . '<br><br>';
$cartController->CartAdd($television3);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ' . $smartphone3->name . '<br><br>';
$cartController->CartAdd($smartphone3);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ' . $fryingPan2->name . '<br><br>';
$cartController->CartAdd($fryingPan2);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ещё ' . $fryingPan2->name . '<br><br>';
$cartController->CartAdd($fryingPan2);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ещё ' . $television3->name . '<br><br>';
$cartController->CartAdd($television3);
var_dump('order:', $cartController->cart());

echo 'Добавляем в корзину ещё ' . $television3->name . '<br><br>';
$cartController->CartAdd($television3);
var_dump('order:', $cartController->cart());

echo 'Удаляем из корзины ' . $television3->name . '<br><br>';
$cartController->CartRemove($television3);
var_dump('order:', $cartController->cart());

echo 'Удаляем из корзины ' . $television3->name . '<br><br>';
$cartController->CartRemove($television3);
var_dump('order:', $cartController->cart());

echo 'Удаляем из корзины ' . $television3->name . '<br><br>';
$cartController->CartRemove($television3);
var_dump('order:', $cartController->cart());

echo 'Удаляем сессию <br><br>';
session_destroy();