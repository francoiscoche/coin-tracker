<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Entity\Currency;

class CurrencyTest extends TestCase
{


   /*
    On vient tester l'entity User avec trois fonctions :
        testIsTrue()
        testIsFalse()
        testIsEmpty()
    */
    public function testIsTrue()
    {
        $currency = new Currency();

        $currency->setName('name')
                 ->setSymbol('symbol');

        $this->assertTrue($currency->getName() === 'name');
        $this->assertTrue($currency->getSymbol() === 'symbol');
    }

    public function testIsFalse()
    {
        $currency = new Currency();

        $currency->setName('name')
                  ->setSymbol('symbol');

        $this->assertFalse($currency->getSymbol() === 'false');
        $this->assertFalse($currency->getName() === 'false');
    }
}
