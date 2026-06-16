<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(): View
    {
        $home = Setting::getGroup('home')->data;

        $aboutPhotoUrl = !empty($home['about_photo'])
            ? Storage::disk('public')->url($home['about_photo'])
            : '/images/about-photo.png';

        $aboutPhotoWebp = empty($home['about_photo']) ? '/images/about-photo.webp' : null;

        $laravelImageUrl = !empty($home['tech_laravel_image'])
            ? Storage::disk('public')->url($home['tech_laravel_image'])
            : '/images/laravel-mark.jpg';

        $laravelImageWebp = empty($home['tech_laravel_image']) ? '/images/laravel-mark.webp' : null;

        $featureIcons = [
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v6c0 1.7 3.6 3 8 3s8-1.3 8-3V5"/><path d="M4 11v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/></svg>',
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M4 20c0-3.3 3.6-6 8-6s8 2.7 8 6"/></svg>',
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 7l9 6 9-6"/></svg>',
            '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 3h14v18H5z"/><path d="M9 8h6"/><path d="M9 12h6"/><path d="M9 16h3"/></svg>',
        ];

        return view('home', [
            'user'            => auth()->user() ?? false,
            'home'            => $home,
            'aboutPhotoUrl'    => $aboutPhotoUrl,
            'aboutPhotoWebp'   => $aboutPhotoWebp,
            'laravelImageUrl'  => $laravelImageUrl,
            'laravelImageWebp' => $laravelImageWebp,
            'featureIcons'     => $featureIcons,
            'contactPhotoUrl'  => '/images/contact-photo.png',
            'contactPhotoWebp' => '/images/contact-photo.webp',
        ]);
    }
}
