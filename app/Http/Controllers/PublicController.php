<?php

namespace App\Http\Controllers;

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

        // generate link
        // save name, phone, link
        // return link
        return to_route('link', [
            'username' => $username,
            'link' => $linkPart,
        ]);
        // expiration -> migration
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
