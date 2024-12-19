<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTimeImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('register');
    }

    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'bail|required|unique:users',
            'phone' => 'bail|required|digits_between:10,15',
        ]);

        $username = $validated['username'];
        $phone = $validated['phone'];

        $linkPart = uniqid();

        $user = new User();
        $user->username = $username;
        $user->phonenumber = $phone;
        $user->link_token = $linkPart;
        $user->expired_at = new DateTimeImmutable('+7 days');

        $user->save();

        return to_route('link', [
            'username' => $username,
            'link' => $linkPart,
        ]);
    }

    public function showLink(string $username, string $link): View
    {
        $linkToShow = url($link);

        return view('link', [
            'username' => $username,
            'link' => $linkToShow,
        ]);
    }
}
