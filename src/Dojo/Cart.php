<?php

namespace Dojo;

class Cart
{
    const PRICE = 8;
    const DISCOUNT_STEP = 0.05;

    private $value = 0;
    private $size = 0;

    private $books = [];

    public function add($book, $qty)
    {
        if (!empty($this->books[$book])) {
            $this->books[$book] += $qty;
        } else {
            $this->books[$book] = $qty;
        }
        $this->size += 1 * $qty;
    }

    public function size()
    {
        return $this->size;
    }

    public function value()
    {
        $books = $this->books;
        $value = 0;
        while (array_sum($books)) {
            $count = 0;
            for ($i = 1; $i <= 5; $i++) {
                if (!empty($books[$i])) {
                    $count++;
                    $books[$i]--;
                }
            }
            $discountRate = ($count - 1) * self::DISCOUNT_STEP;
            if ($count > 3) {
                $discountRate += self::DISCOUNT_STEP;
            }
            $value += ($count * self::PRICE) * (1 - $discountRate);
        }

        return $value;
    }

    public function getCount($bookId)
    {
        return $this->books[$bookId];
    }

}
