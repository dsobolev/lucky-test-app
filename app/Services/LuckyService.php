<?php

namespace App\Services;

class LuckyService
{
    public static function number(): int
    {
        return rand(1, 1000);
    }

    public static function isWin(int $number): bool
    {
        return $number % 2 === 0;
    }

    public static function getPrize(int $number): int
    {
        $result = match (true) {
            $number > 900 => $number * 0.7,
            $number > 600 => $number * 0.5,
            $number > 300 => $number * 0.3,
            default => $number * 0.1,
        };

        return floor($result);
    }
}
