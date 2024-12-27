<?php

namespace App\Http\Controllers;

use App\DTO\AttemptDto;
use App\Jobs\SaveAttempt;
use App\Models\User;
use App\Services\Formatter;
use App\Services\LuckyService;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(string $link): View
    {
        $user = User::where('link_token', $link)->first();

        return view('lucky', [
            'username' => $user->username,
        ]);
    }

    public function getLucky(string $link): JsonResponse
    {
        $number = LuckyService::number();
        $isWin = LuckyService::isWin($number);

        $attmeptData = new AttemptDto(number: $number, isWin: $isWin);

        if ($isWin) {
            $attmeptData->setPrize(LuckyService::getPrize($number));
        }

        SaveAttempt::dispatch($link, $attmeptData);

        return response()->json($attmeptData);
    }

    public function regenerate(string $link): JsonResponse
    {
        $user = User::where('link_token', $link)->first();

        if (is_null($user)) {
            return response()->json(['message' => 'Link not found'], 404);
        }

        $linkPart = uniqid();

        $user->link_token = $linkPart;
        $user->expired_at = new DateTimeImmutable('+7 days');

        $user->save();

        return response()->json([
            'link' => $linkPart
        ]);
    }

    public function deactivate(string $link): JsonResponse
    {
        $user = User::where('link_token', $link)->first();

        if (is_null($user)) {
            return response()->json(['message' => 'Link not found'], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'ok'
        ]);
    }

    public function history(string $link): JsonResponse
    {
        $attempts = User::where('link_token', $link)
            ->first()
            ->attempts()
            ->latest()
            ->take(3)
            ->get();

        $formattedAttempts = $attempts->map(fn ($attempt) => Formatter::formatAttempt($attempt));

        return response()->json($formattedAttempts->all());
    }
}
