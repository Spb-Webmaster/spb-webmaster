<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class GuaranteesController extends Controller
{
    public function index(): View
    {
        $g = Setting::getGroup('guarantees')->data ?? [];

        $stepIcons = [
            '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 4v5c0 4.4-3 7.6-7 9-4-1.4-7-4.6-7-9V7l7-4z"/><path d="M9 12l2 2 4-4"/></svg>',
            '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10.3 3.6L1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.6a2 2 0 0 0-3.4 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
            '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a4 4 0 0 1-5.4 5.4L4 17v3h3l5.3-5.3a4 4 0 0 1 5.4-5.4l-2.6 2.6-1.4-1.4 2.6-2.6z"/></svg>',
        ];

        $steps = [];
        foreach (($g['steps'] ?? []) as $i => $s) {
            $steps[] = [
                'n'     => $i + 1,
                'title' => $s['title'] ?? '',
                'desc'  => $s['desc'] ?? '',
                'icon'  => $stepIcons[$i] ?? $stepIcons[0],
            ];
        }

        $stats   = $g['stats'] ?? [];
        $covered = array_map(fn($item) => $item['text'] ?? '', $g['covered'] ?? []);
        $voided  = array_map(fn($item) => $item['text'] ?? '', $g['voided'] ?? []);

        $iconPanel = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 4h18v16H3z"/><path d="M3 9h18"/><path d="M7 6.5h.01"/><path d="M10 6.5h.01"/></svg>';
        $iconCode  = '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 9l-3 3 3 3"/><path d="M16 9l3 3-3 3"/><path d="M13 7l-2 10"/></svg>';

        return view('pages.guarantees', compact('g', 'steps', 'stats', 'covered', 'voided', 'iconPanel', 'iconCode'));
    }
}
