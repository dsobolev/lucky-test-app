<?php

namespace App\Services;

use App\DTO\AttemptDto;
use App\Models\Attempt;

class Formatter
{
    public static function formatAttempt(Attempt $attemptEntity): AttemptDto
    {
        return new AttemptDto(
            number: $attemptEntity->number,
            isWin: $attemptEntity->win,
            prize: $attemptEntity->sum
        );
    }
}
