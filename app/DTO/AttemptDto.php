<?php

namespace App\DTO;

class AttemptDto
{
    public function __construct(
        public readonly int $number,
        public readonly bool $isWin,
        public int $prize = 0
    ){}

    public function setPrize(int $value): void
    {
        $this->prize = $value;
    }
}
