<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Pages;

use App\Models\Setting;
use MoonShine\Crud\JsonResponse;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Laravel\TypeCasts\ModelCaster;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Enums\ToastType;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class WorksPage extends Page
{
    public function getTitle(): string
    {
        return 'Работы';
    }

    private function getSetting(): Setting
    {
        return Setting::getGroup('works');
    }

    #[AsyncMethod]
    public function store(): JsonResponse
    {
        $this->form()->apply(fn(Setting $item) => $item->save());

        return JsonResponse::make()->toast('Сохранено', ToastType::SUCCESS);
    }

    private function form(): FormBuilder
    {
        return FormBuilder::make()
            ->asyncMethod('store')
            ->fillCast($this->getSetting(), new ModelCaster(Setting::class))
            ->fields([
                Box::make([
                    Tabs::make([
                        $this->tabHero(),
                        $this->tabProjects(),
                        $this->tabCta(),
                        $this->tabSeo(),
                    ]),
                ]),
            ])
            ->submit('Сохранить', ['class' => 'btn-primary']);
    }

    // -------------------------------------------------------------------------
    // Вкладка: Hero
    // -------------------------------------------------------------------------
    private function tabHero(): Tab
    {
        return Tab::make('Hero', [
            Textarea::make('Подзаголовок', 'hero_subtitle')
                ->default('Сайты и веб-сервисы, которые мы спроектировали и разработали для бизнеса из разных отраслей — от турагентств и страхования до государственных реестров и билетных систем.'),

            Divider::make('Цифры-статистика'),

            Json::make('Статистика', 'stats')
                ->fields([
                    Text::make('Значение', 'value'),
                    Text::make('Подпись', 'label'),
                ])
                ->default([
                    ['value' => '5',      'label' => 'реализованных проектов'],
                    ['value' => '5',      'label' => 'разных отраслей'],
                    ['value' => 'с 2009', 'label' => 'года на рынке'],
                ])
                ->creatable(limit: 4)
                ->removable()
                ->vertical(),
        ])->icon('photo');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Проекты
    // -------------------------------------------------------------------------
    private function tabProjects(): Tab
    {
        return Tab::make('Проекты', [
            Json::make('Проекты', 'projects')
                ->fields([
                    Text::make('ID', 'id')
                        ->hint('Латиница без пробелов, уникальный: hottour, generalre, mediator…'),

                    Text::make('Категория (фильтр)', 'cat')
                        ->hint('Точно: Туризм / Страхование / Госсектор / Экспертиза / Билеты'),

                    Text::make('Категория (подпись на карточке)', 'category')
                        ->hint('Например: Турагентство'),

                    Text::make('Название проекта', 'title'),

                    Textarea::make('Описание', 'desc'),

                    Json::make('Технологии', 'tech')
                        ->fields([
                            Text::make('Тег', 'value'),
                        ])
                        ->vertical()
                        ->creatable(limit: 6)
                        ->removable(),

                    Json::make('Скриншоты', 'images')
                        ->fields([
                            Image::make('Изображение', 'image')
                                ->disk('public')
                                ->dir('images/works')
                                ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                                ->removable(),
                        ])
                        ->vertical()
                        ->creatable(limit: 3)
                        ->removable(),
                ])
                ->creatable()
                ->removable()
                ->vertical(),
        ])->icon('briefcase');
    }

    // -------------------------------------------------------------------------
    // Вкладка: CTA
    // -------------------------------------------------------------------------
    private function tabCta(): Tab
    {
        return Tab::make('CTA', [
            Text::make('Заголовок', 'cta_h2')
                ->default('Хотите такой же проект?'),

            Text::make('Текст', 'cta_p')
                ->default('Расскажите о задаче — бесплатно оценим объём и предложим решение под ваш бюджет.'),
        ])->icon('cursor-arrow-rays');
    }

    // -------------------------------------------------------------------------
    // Вкладка: SEO
    // -------------------------------------------------------------------------
    private function tabSeo(): Tab
    {
        return Tab::make('SEO', [
            Text::make('Мета-заголовок', 'metatitle')->unescape(),
            Text::make('Мета-описание', 'description')->unescape(),
            Text::make('Ключевые слова', 'keywords')->unescape(),
        ])->icon('magnifying-glass');
    }

    protected function components(): iterable
    {
        yield $this->form();
    }
}
