<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.panel.profile.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        // TODO: implement profile update
        return redirect()->route('admin.profile.edit')->with('status', 'Profile updated');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        // TODO: implement password update
        return redirect()->route('admin.profile.edit')->with('status', 'Password updated');
    }
}
