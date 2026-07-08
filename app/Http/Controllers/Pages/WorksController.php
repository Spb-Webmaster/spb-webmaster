<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class WorksController extends Controller
{
    public function index(): View
    {
        $w = Setting::getGroup('works')->data ?? [];

        $stats = $w['stats'] ?? [];

        $cats = ['Все', 'Страхование', 'Туризм', 'Госсектор', 'Экспертиза', 'Билеты22'];

        $projects = is_array($w['projects'] ?? null) ? $w['projects'] : [];

        foreach ($projects as &$project) {
            $firstImg = $project['images'][0]['image'] ?? '';
            if (is_array($firstImg)) {
                $firstImg = reset($firstImg) ?: '';
            }
            $project['cover_path'] = (string) $firstImg;

            foreach ($project['images'] as &$img) {
                $path = $img['image'] ?? '';
                if (is_array($path)) {
                    $path = reset($path) ?: '';
                }
                $path = (string) $path;
                $img['url'] = ($path === '' || str_starts_with($path, 'http') || str_starts_with($path, '/'))
                    ? $path
                    : asset('storage/' . $path);
            }
            unset($img);
        }
        unset($project);

        return view('pages.works', compact('w', 'stats', 'cats', 'projects'));
    }
}
