<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Pages\Pages\ContactPage;
use App\MoonShine\Pages\Pages\GuaranteesPage;
use App\MoonShine\Pages\Pages\HomePage;
use App\MoonShine\Pages\Pages\NewsPage;
use App\MoonShine\Pages\Pages\SettingPage;
use App\MoonShine\Pages\Pages\WorksPage;
use App\MoonShine\Resources\City\CityResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use MoonShine\AssetManager\Js;
use MoonShine\ColorManager\ColorManager;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuDivider;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use YuriZoom\MoonShineMediaManager\Pages\MediaManagerPage;


final class AxeldLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
            new Js('/js/admin/tab-persist.js'),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('Пользователи', [
                MenuItem::make(MoonShineUserResource::class, 'Админ', 'user'),
                MenuDivider::make(),

            ]),


            MenuGroup::make(static fn() => __('Страницы'), [
                MenuItem::make(HomePage::class, 'Главная', 'home'),
                MenuItem::make(GuaranteesPage::class, 'Гарантии', 'shield-check'),
                MenuItem::make(WorksPage::class, 'Работы', 'briefcase'),
                MenuItem::make(ContactPage::class, 'Контакты', 'phone'),
                MenuDivider::make(),
                MenuItem::make(NewsPage::class, 'Новости', 'document-text'),

            ]),





            MenuGroup::make(static fn() => __('Настройки'), [
                MenuItem::make(CityResource::class, 'Города', 'building-office-2'),
                MenuItem::make(SettingPage::class, 'Константы', 'adjustments-vertical'),
                MenuItem::make(MediaManagerPage::class, 'Media', 'film'),


                ]),




        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    protected function getFooterCopyright(): string
    {
        return \sprintf(
            <<<'HTML'
                &copy; %d Spb-Webmaster
                <a href="/"
                    class="font-semibold text-primary"
                    target="_blank"
                >
                   Поддержка сайтов
                </a>
                HTML,
            now()->year,
        );
    }

    protected function getFooterMenu(): array
    {
        return [
            config('app.url') => 'WebSite',
        ];
    }
}
