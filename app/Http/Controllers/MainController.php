<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
