<?php

namespace Tests\Unit;

use App\Services\LuckyService;
use PHPUnit\Framework\TestCase;

class LuckyServiceTest extends TestCase
{
    public function test_win(): void
    {
        // even
        $isWin = LuckyService::isWin(20);

        $this->assertTrue($isWin);
    }

    public function test_lost(): void
    {
        // odd
        $isWin = LuckyService::isWin(21);

        $this->assertFalse($isWin);
    }

    public function test_win_70_percent(): void
    {
        $num = 950;
        $prize = LuckyService::getPrize($num);

        $this->assertEquals($num * 0.7, $prize);
    }

    public function test_win_50_percent(): void
    {
        $num = 700;
        $prize = LuckyService::getPrize($num);

        $this->assertEquals($num * 0.5, $prize);
    }

    public function test_win_30_percent(): void
    {
        $num = 360;
        $prize = LuckyService::getPrize($num);

        $this->assertEquals($num * 0.3, $prize);
    }

    public function test_win_10_percent(): void
    {
        $num = 20;
        $prize = LuckyService::getPrize($num);

        $this->assertEquals($num * 0.1, $prize);
    }
}
