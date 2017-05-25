<?php


class CartTest extends \PHPUnit\Framework\TestCase
{
    public function testCartCreation()
    {
        $cart = new \Dojo\Cart();
        $this->assertNotEmpty($cart);
    }

    public function testAdding()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 1);
        $this->assertEquals(1, $cart->size());
    }

    public function testOneBookValue()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 1);
        $this->assertEquals(8, $cart->value());
    }

    public function testEmptyCart()
    {
        $cart = new \Dojo\Cart();
        $this->assertEquals(0, $cart->value());
    }

    public function testTwoBooksCartSize()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 1);
        $cart->add(2, 1);
        $this->assertEquals(2, $cart->size());
    }

    public function testBulkAddCartSize()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 22);
        $this->assertEquals(22, $cart->size());
    }

    public function testTwoDiffBooksValue()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 1);
        $cart->add(2, 1);
        $discountVal = 0.05 * 16;
        $this->assertEquals(16 - $discountVal, $cart->value());
    }

    public function testTwoBookPacket()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 3);
        $cart->add(2, 2);
        $value = (2 * 8 * (1 - 0.05)) * 2 + 8;
        $this->assertEquals($value, $cart->value());
    }

    public function testMultipleAddsSize()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 3);
        $cart->add(2, 1);
        $cart->add(1, 1);
        $this->assertEquals(5, $cart->size());
    }

    public function testMultipleAddsCount()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 3);
        $cart->add(2, 1);
        $cart->add(1, 1);
        $this->assertEquals(4, $cart->getCount(1));
    }

    public function testMultipleAddsValue()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 3);
        $cart->add(2, 1);
        $cart->add(1, 1);
        //                        1,2              3 * 1
        $this->assertEquals((2 * 8 * (1 - 0.05)) + 8 * 3, $cart->value());
    }

    public function test4PackValue()
    {
        $cart = new \Dojo\Cart();
        $cart->add(1, 1);
        $cart->add(2, 1);
        $cart->add(3, 1);
        $cart->add(4, 1);
        $this->assertEquals(4 * 8 * (1 - 0.2), $cart->value());
    }

    public function testFinalValue()
    {
        //2 copies of the first book
        //2 copies of the second book
        //2 copies of the third book
        //1 copy of the fourth book
        //1 copy of the fifth book
        //
        //(answer: 51.20 EUR)

        $cart = new \Dojo\Cart();
        $cart->add(1, 2);
        $cart->add(2, 2);
        $cart->add(3, 2);
        $cart->add(4, 1);
        $cart->add(5, 1);
        $this->assertEquals(51.2, $cart->value());
    }
}
