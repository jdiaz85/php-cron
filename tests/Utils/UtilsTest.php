<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Utils\Utils;

class UtilsTest extends TestCase
{

    /**
     * @test
     */
    public function betweenWithIncludedExtremesOK(): void
    {
        $this->assertTrue(Utils::betweenWithIncludedExtremes(0, 0, 10));
        $this->assertTrue(Utils::betweenWithIncludedExtremes(10, 0, 10));
        $this->assertTrue(Utils::betweenWithIncludedExtremes(5, 0, 10));
    }


    /**
     * @test
     */
    public function betweenWithIncludedExtremesLow(): void
    {
        $this->assertFalse(Utils::betweenWithIncludedExtremes(-1, 0, 10));
    }


    /**
     * @test
     */
    public function betweenWithIncludedExtremesHigh(): void
    {
        $this->assertFalse(Utils::betweenWithIncludedExtremes(11, 0, 10));
    }
}
