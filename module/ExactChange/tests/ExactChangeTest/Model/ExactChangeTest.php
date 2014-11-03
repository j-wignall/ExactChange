<?php
namespace ExactChangeTest\Model;

use ExactChange\Model\ExactChange;

use PHPUnit_Framework_TestCase;

class ExactChangeTest extends PHPUnit_Framework_TestCase
{
    public function testExactChangeInitialState()
    {
        $change = new ExactChange();

        $this->assertNull($change->id, '"id" should initially be null');
        $this->assertNull($change->minNumberOfCoins, '"minNumberOfCoins" should initially be null');
        $this->assertNull($change->exactCoins, '"exactCoins" should initially be null');
    }

    public function testExchangeArraySetsPropertiesCorrectly()
    {
        $change = new ExactChange();
        $data  = array(
            'id'     => 123,
            'minNumberOfCoins'  => 'some minNumberOfCoins',
            'exactCoins' => 'some exactCoins');

        $change->exchangeArray($data);

        $this->assertSame($data['id'], $change->id, '"id" was not set correctly');
        $this->assertSame($data['minNumberOfCoins'], $change->minNumberOfCoins, '"minNumberOfCoins" was not set correctly');
        $this->assertSame($data['exactCoins'], $change->exactCoins, '"exactCoins" was not set correctly');
    }

    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
    {
        $change = new ExactChange();

        $change->exchangeArray(array(
            'id'     => 123,
            'minNumberOfCoins'  => 'some minNumberOfCoins',
            'exactCoins' => 'some exactCoins')
        );
        $change->exchangeArray(array());

        $this->assertNull($change->id, '"id" should have defaulted to null');
        $this->assertNull($change->minNumberOfCoins, '"minNumberOfCoins" should have defaulted to null');
        $this->assertNull($change->exactCoins, '"exactCoins" should have defaulted to null');
    }
}
