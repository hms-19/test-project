<?php

use PHPUnit\Framework\TestCase;
require_once 'index.php'; 

class CalculatorTest extends TestCase
{
    public function testapplyInstruct()
    {
        $calculator = new Calculator();
        $calculator->applyInstruct('add', 5);
        $this->assertEquals(5, $calculator->result());
    }

    public function testSubtractInstruct()
    {
        $calculator = new Calculator(10);
        $calculator->applyInstruct('subtract', 3);
        $this->assertEquals(7, $calculator->result());
    }

    public function testMultiplyInstruct()
    {
        $calculator = new Calculator(2);
        $calculator->applyInstruct('multiply', 4);
        $this->assertEquals(8, $calculator->result());
    }

    public function testDivideInstruct()
    {
        $calculator = new Calculator(10);
        $calculator->applyInstruct('divide', 2);
        $this->assertEquals(5, $calculator->result());
    }

    public function testInstruct()
    {
        $calculator = new Calculator();
        $calculator->applyInstruct('apply', 10);
        $this->assertEquals(10, $calculator->result());
    }


    public function testInvalidOperator()
    {
        try {
            $calculator = new Calculator();
            $calculator->applyInstruct('unknown', 5);
            $this->fail('Expected InvalidArgumentException was not thrown.');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals('Error: Unknown operator \'unknown\'', $e->getMessage());
        }
    }

    public function testDivisionByZero()
    {
        try {
            $calculator = new Calculator();
            $calculator->applyInstruct('divide', 0);
            $this->fail('Expected InvalidArgumentException was not thrown.');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals('Error: Division by zero', $e->getMessage());
        }
    }


}

?>