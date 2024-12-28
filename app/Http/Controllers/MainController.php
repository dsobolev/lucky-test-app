<?php

namespace App\Http\Controllers;

use App\DTO\AttemptDto;
use App\Http\Middleware\CheckLink;
use App\Http\Middleware\CheckLinkJson;
use App\Jobs\SaveAttempt;
use App\Models\User;
use App\Services\Formatter;
use App\Services\LuckyService;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\View\View;

class MainController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(CheckLink::class, only: ['index']),
            new Middleware(CheckLinkJson::class, except: ['index']),
        ];
    }

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
