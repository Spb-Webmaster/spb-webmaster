<?php

namespace App\View\Components\Menu;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

class SiteMenu extends Component
{
    public array $items;

    public function __construct(
        public string $variant = 'desktop',
        ?array $items = null,
    ) {
        $this->items = array_map(
            fn(array $item) => $this->prepareItem($item),
            $items ?? $this->defaultItems(),
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.menu.site-menu');
    }

    private function defaultItems(): array
    {
        return [
            [
                'label' => 'О студии',
                'href' => route('home') . '#services',
                'active' => false,
            ],
            [
                'label' => 'Гарантии',
                'href' => route('guarantees'),
                'active' => request()->routeIs('guarantees'),
            ],
            [
                'label' => 'Работы',
                'href' => route('works'),
                'active' => request()->routeIs('works'),
            ],
            [
                'label' => 'Контакты',
                'href' => route('contacts'),
                'active' => request()->routeIs('contacts'),
            ],
        ];
    }

    private function prepareItem(array $item): array
    {
        return [
            'label' => $item['label'],
            'attributes' => new ComponentAttributeBag(array_filter([
                'href' => $item['href'],
                'class' => $this->itemClass((bool) ($item['active'] ?? false)),
            ])),
        ];
    }

    private function itemClass(bool $active): string
    {
        return match ($this->variant) {
            'desktop' => 'spb-nav-link' . ($active ? ' spb-nav-link--active' : ''),
            'drawer' => $active ? 'is-active' : '',
            'footer' => 'spb-footer-link',
            default => '',
        };
    }
}
