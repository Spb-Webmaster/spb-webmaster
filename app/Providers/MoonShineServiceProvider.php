<?php

declare(strict_types=1);

namespace App\Providers;

use App\MoonShine\Pages\Pages\ContactPage;
use App\MoonShine\Pages\Pages\GuaranteesPage;
use App\MoonShine\Pages\Pages\HomePage;
use App\MoonShine\Pages\Pages\NewsPage;
use App\MoonShine\Pages\Pages\SettingPage;
use App\MoonShine\Pages\Pages\WorksPage;
use App\MoonShine\Resources\City\CityResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\News\NewsResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  CoreContract<MoonShineConfigurator>  $core
     */
    public function boot(CoreContract $core): void
    {
        $core
            ->resources([
                CityResource::class,
                NewsResource::class,
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
                HomePage::class,
                ContactPage::class,
                GuaranteesPage::class,
                NewsPage::class,
                WorksPage::class,
                SettingPage::class,
            ])
        ;
    }
}

