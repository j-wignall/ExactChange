<?php
namespace ExactChangeTest\Model;

use ExactChange\Model\ExactChange;

use ExactChange\Validator\MonetaryAmount;
use PHPUnit_Framework_TestCase;

class MonetaryAmountTest extends PHPUnit_Framework_TestCase {

    public function testForInvalidCharacters() {
        $validator = new MonetaryAmount();
        $str = '13x';
        $result = $validator->isValid($str);
        $this->assertFalse($result);
    }

    public function testForMissingValue() {
        $validator = new MonetaryAmount();
        $str = '£p';
        $result = $validator->isValid($str);
        $this->assertFalse($result);

        $expected = "Missing value in '£p'";
        $actual = $validator->getMessages();

        $this->assertSame($expected, $actual['msgMissingValue']);
    }

    public function testValidPenceCharacterInWrongPosition() {
        $validator = new MonetaryAmount();
        $str = '13p.02';
        $result = $validator->isValid($str);
        $this->assertFalse($result);
        $expected = "Valid character in wrong position in '13p.02'";
        $actual = $validator->getMessages();
        $this->assertSame($expected, $actual['msgValidCharWrongPosition']);
    }

    public function testValidPoundCharacterInWrongPosition() {
        $validator = new MonetaryAmount();
        $str = '13£.02';
        $result = $validator->isValid($str);
        $this->assertFalse($result);
        $expected = "Valid character in wrong position in '13£.02'";
        $actual = $validator->getMessages();
        $this->assertSame($expected, $actual['msgValidCharWrongPosition']);
    }

    public function testInvalidInputX() {
        $validator = new MonetaryAmount();
        $str = '-30p';
        $result = $validator->isValid($str);
        $this->assertFalse($result);
    }

    public function testInvalidInputY() {
        $validator = new MonetaryAmount();
        $str = '-50';
        $result = $validator->isValid($str);
        $this->assertFalse($result);
    }

    public function testInvalidInputZ() {
        $validator = new MonetaryAmount();
        $str = 'twentytwop';
        $result = $validator->isValid($str);
        $this->assertFalse($result);
    }

    public function testValidInput1() {
        $validator = new MonetaryAmount();
        $str = '432';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }

    public function testValidInput2() {
        $validator = new MonetaryAmount();
        $str = '213p';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }

    public function testValidInput3() {
        $validator = new MonetaryAmount();
        $str = '£16.23p';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }

    public function testValidInput4() {
        $validator = new MonetaryAmount();
        $str = '£14';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }

    public function testValidInput5() {
        $validator = new MonetaryAmount();
        $str = '£54.04';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }

    public function testValidInput6() {
        $validator = new MonetaryAmount();
        $str = '£23.33333';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }

    public function testValidInput7() {
        $validator = new MonetaryAmount();
        $str = '001.41p';
        $result = $validator->isValid($str);
        $this->assertTrue($result);
    }
}