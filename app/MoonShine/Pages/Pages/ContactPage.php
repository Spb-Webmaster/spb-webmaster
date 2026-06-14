<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Pages;

use App\Models\Setting;
use Illuminate\Http\Request;
use MoonShine\Crud\JsonResponse;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Enums\ToastType;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class ContactPage extends Page
{
    public function getTitle(): string
    {
        return 'Контакты';
    }

    private function getSetting(): Setting
    {
        return Setting::getGroup('contact');
    }

    #[AsyncMethod]
    public function store(Request $request): JsonResponse
    {
        $setting = $this->getSetting();
        $setting->data = $request->except(['_token', '_method']);
        $setting->save();

        return JsonResponse::make()->toast('Сохранено', ToastType::SUCCESS);
    }

    private function form(): FormBuilder
    {
        return FormBuilder::make()
            ->asyncMethod('store')
            ->fill($this->getSetting()->data ?? [])
            ->fields([
                Box::make([
                    Tabs::make([
                        $this->tabHero(),
                        $this->tabContacts(),
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
            Text::make('H1 — градиентное слово', 'h1_gradient')
                ->default('проекте')
                ->hint('Отображается оранжевым градиентом в H1: «Расскажите о [слово]»'),

            Textarea::make('Подзаголовок', 'subtitle')
                ->default('Оставьте заявку или позвоните — свяжемся в течение рабочего дня, бесплатно оценим объём и предложим решение под ваш бюджет.'),

            Divider::make('Цифры-обещания'),

            Json::make('Обещания', 'pledges')
                ->fields([
                    Text::make('Значение', 'value'),
                    Text::make('Подпись', 'label'),
                ])
                ->default([
                    ['value' => '1 день',    'label' => 'на ответ по заявке'],
                    ['value' => 'Бесплатно', 'label' => 'оценка проекта'],
                    ['value' => 'Договор',   'label' => 'с фиксированной ценой'],
                ])
                ->creatable(limit: 4)
                ->removable()
                ->vertical(),
        ])->icon('chat-bubble-left-ellipsis');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Контакты
    // -------------------------------------------------------------------------
    private function tabContacts(): Tab
    {
        return Tab::make('Контакты', [
            Divider::make('Телефон'),

            Text::make('Номер телефона', 'phone')
                ->default('+7 (921) 397-55-84'),

            Text::make('Ссылка (tel:)', 'phone_href')
                ->default('tel:+79213975584'),

            Divider::make('Email'),

            Text::make('Email', 'email')
                ->default('hello@spb-webmaster.ru'),

            Divider::make('Мессенджеры'),

            Text::make('Текст мессенджеров', 'messenger_text')
                ->default('Telegram · WhatsApp'),

            Text::make('Ссылка мессенджеров', 'messenger_href')
                ->default('#'),
        ])->icon('phone');
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
