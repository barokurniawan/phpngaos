<?php

use phpngaos\Bootstrap\View;
use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testGetInstance()
    {
        $vw = View::getInstance();
        $this->assertTrue($vw instanceof View);
    }
}
