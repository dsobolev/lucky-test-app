<?php

namespace App\Jobs;

use App\DTO\AttemptDto;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SaveAttempt implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $linkToken,
        public AttemptDto $attemptData
    ){}

    public function handle(): void
    {
        $user = User::where('link_token', $this->linkToken)->first();

        $user->attempts()->create([
            'number' => $this->attemptData->number,
            'win' => $this->attemptData->isWin,
            'sum' => $this->attemptData->prize
        ]);
    }
}
