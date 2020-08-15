<?php

use PHPUnit\Framework\TestCase;
use phpngaos\Controller\Welcome;

class WecomeControllerTest extends TestCase
{
    public function testUploadValidation()
    {
        $mockFile = [];
        $mockFile['file']['name'] = "anu.jpg";
        $mockFile['file']['tmp_name'] = "/tmp/anu";

        $w = new Welcome();
        $this->assertTrue($w->UploadValidation($mockFile));
    }
}
