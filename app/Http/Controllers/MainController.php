<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function getLucky(): JsonResponse
    {
        $number = LuckyService::number();
        $isWin = LuckyService::isWin($number);
        $prize = 0;

        if ($isWin) {
            $prize = LuckyService::getPrize($number);
        }

        return response()->json(compact('number', 'isWin', 'prize'));
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
}
