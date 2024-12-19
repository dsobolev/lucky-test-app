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
            'phone' => 'required',
        ]);

        $username = $request->input('username');
        $phone = $request->input('phone');


        // generate link
        // save name, phone, link
        // return link
        return to_route('post.show', ['link' => $link]);
        // expiration -> migration
    }
}
