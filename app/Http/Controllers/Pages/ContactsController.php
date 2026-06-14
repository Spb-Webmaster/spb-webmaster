<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class ContactsController extends Controller
{
    public function index(): View
    {
        $c = Setting::getGroup('contact')->data ?? [];

        $pledges = $c['pledges'] ?? [];

        return view('pages.contacts', compact('c', 'pledges'));
    }
}
