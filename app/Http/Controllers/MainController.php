<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\LuckyService;
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
        $win = LuckyService::isWin($number);
        $prize = 0;

        if ($isWin) {
            $prize = LuckyService::getPrize($number);
        }

        return response()->json(compact($number, $isWin, $prize));
    }
}
