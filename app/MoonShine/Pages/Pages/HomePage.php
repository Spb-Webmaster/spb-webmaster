<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Pages;

use App\Models\Setting;
use Illuminate\Http\Request;
use MoonShine\Crud\JsonResponse;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Enums\ToastType;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class HomePage extends Page
{
    public function getTitle(): string
    {
        return 'Главная';
    }

    private function getSetting(): Setting
    {
        return Setting::getGroup('home');
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
                        $this->tabAbout(),
                        $this->tabTech(),
                        $this->tabGuarantees(),
                        $this->tabIncluded(),
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
            Grid::make([
                Column::make([
                    Text::make('Бейдж над заголовком', 'hero_badge')
                        ->default('Онлайн-студия разработки сайтов')
                        ->hint('Маленькая плашка-метка в верхней части блока'),
                ])->columnSpan(8),
            ]),

            Text::make('Заголовок H1', 'hero_h1')
                ->default('Сайт под ключ для вашего дела')
                ->required(),

            Textarea::make('Подзаголовок', 'hero_subtitle')
                ->default('Оригинальный дизайн, фиксированная цена и базовое SEO в каждом проекте. Делаем сайты для частных специалистов и небольших компаний — от визитки до магазина.'),

            Divider::make('Шаги процесса'),

            Json::make('Шаги', 'hero_steps')
                ->fields([
                    Text::make('Номер', 'n')->default('01'),
                    Text::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'desc'),
                ])
                ->default([
                    ['n' => '01', 'title' => 'Договор',    'desc' => 'Обсуждаем задачи, заполняем бриф, собираем материалы. Заключаем договор.'],
                    ['n' => '02', 'title' => 'Дизайн',     'desc' => 'Рисуем оригинальный макет под ваш проект и согласуем его с вами.'],
                    ['n' => '03', 'title' => 'Разработка', 'desc' => 'Вёрстка, наполнение, адаптив и базовая SEO-оптимизация.'],
                    ['n' => '04', 'title' => 'Запуск',     'desc' => 'Публикуем сайт, обучаем работе и сопровождаем после старта.'],
                ])
                ->creatable(limit: 6)
                ->removable()
                ->vertical(),
        ])->icon('rocket-launch');
    }

    // -------------------------------------------------------------------------
    // Вкладка: О студии
    // -------------------------------------------------------------------------
    private function tabAbout(): Tab
    {
        return Tab::make('О студии', [
            Text::make('Заголовок H2', 'about_h2')
                ->default('Не шаблоны, а инструменты для бизнеса')
                ->required(),

            Text::make('Подпись студии (под шестерёнкой)', 'about_founded')
                ->default('Онлайн-студия Spb-Webmaster · Санкт-Петербург, с 2009 года'),

            Grid::make([
                Column::make([
                    Number::make('Лет опыта', 'about_years')
                        ->default(25)
                        ->min(1)
                        ->max(99),
                ])->columnSpan(3),

                Column::make([
                    Text::make('Подпись к цифре', 'about_years_text')
                        ->default('лет создаём сайты в Санкт-Петербурге'),
                ])->columnSpan(9),
            ]),

            Image::make('Фото (блок О студии)', 'about_photo')
                ->disk('public')
                ->dir('home')
                ->hint('Если не загружено — используется /images/about-photo.png'),

            Divider::make('Тексты'),


            TinyMce::make('Описание', 'about_p'),


            Divider::make('SEO-теги (чипы под текстом)'),

            Json::make('SEO-теги', 'about_seo_tags')
                ->fields([
                    Text::make('Тег', 'tag'),
                ])
                ->default([
                    ['tag' => 'Метатеги'],
                    ['tag' => 'Скорость загрузки'],
                    ['tag' => 'Schema.org'],
                    ['tag' => 'Open Graph'],
                ])
                ->creatable(limit: 8)
                ->removable()
                ->vertical(),
        ])->icon('user-group');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Технологии
    // -------------------------------------------------------------------------
    private function tabTech(): Tab
    {
        return Tab::make('Технологии', [
            Text::make('Заголовок H2', 'tech_h2')
                ->default('Создаём сайты на Laravel')
                ->required(),

            Textarea::make('Описание под заголовком', 'tech_desc')
                ->default('Laravel — современный фреймворк для сайтов и веб-приложений на PHP. Это готовый «конструктор» для разработчика: вместо того чтобы делать всё с нуля, мы собираем проект из проверенных модулей — быстрее, надёжнее и удобнее для развития.'),

            Divider::make('Laravel-карточка (левый блок)'),

            Image::make('Логотип Laravel', 'tech_laravel_image')
                ->disk('public')
                ->dir('home')
                ->hint('Если не загружено — используется /images/laravel-mark.jpg'),

            Text::make('Заголовок карточки', 'tech_laravel_title')
                ->default('Готовый конструктор, а не стройка с нуля'),

            Textarea::make('Текст карточки', 'tech_laravel_desc')
                ->default('Представьте дом из готовых стен, крыши и инженерных систем вместо самодельных кирпичей. Laravel даёт такие «детали» — мы собираем из них именно то, что нужно вашему бизнесу.'),

            Json::make('Преимущества Laravel (чипы)', 'tech_benefits')
                ->fields([
                    Text::make('Текст', 'text'),
                ])
                ->default([
                    ['text' => 'Быстрее запуск'],
                    ['text' => 'Надёжный код'],
                    ['text' => 'Легко развивать'],
                ])
                ->creatable(limit: 6)
                ->removable()
                ->vertical(),

            Divider::make('Карточки возможностей (правый блок)'),

            Json::make('Возможности', 'tech_features')
                ->fields([
                    Text::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'desc'),
                ])
                ->default([
                    ['title' => 'Базы данных',    'desc' => 'Надёжное хранение и быстрая работа с данными проекта.'],
                    ['title' => 'Авторизация',    'desc' => 'Регистрация и личные кабинеты пользователей из коробки.'],
                    ['title' => 'Email-рассылки', 'desc' => 'Отправка писем и уведомлений клиентам без сбоев.'],
                    ['title' => 'Обработка форм', 'desc' => 'Заявки и формы с проверкой данных и защитой от спама.'],
                ])
                ->creatable(limit: 8)
                ->removable()
                ->vertical(),
        ])->icon('code-bracket');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Гарантии
    // -------------------------------------------------------------------------
    private function tabGuarantees(): Tab
    {
        return Tab::make('Гарантии', [
            Text::make('Заголовок H2', 'guarantees_h2')
                ->default('Вы защищены на каждом этапе')
                ->required(),

            Textarea::make('Текст справа от заголовка', 'guarantees_desc')
                ->default('Работаем по договору и отвечаем за результат. Сайт остаётся вашим, исходники передаём вам.'),

            Divider::make('Карточки'),

            Json::make('Карточки гарантий', 'guarantees_items')
                ->fields([
                    Text::make('Метка', 'tag'),
                    Text::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'desc'),
                ])
                ->default([
                    ['tag' => 'Гарантия',     'title' => '12 месяцев гарантии',          'desc' => 'Бесплатно исправляем любые технические ошибки в работе сайта в течение года после запуска.'],
                    ['tag' => 'Прозрачность', 'title' => 'Договор и фиксированная цена', 'desc' => 'Стоимость закрепляем в договоре до старта работ — без скрытых доплат в процессе.'],
                    ['tag' => 'Забота',       'title' => 'Бесплатная техподдержка',      'desc' => 'Консультируем и помогаем с обновлениями после запуска — первое время поддержка в подарок.'],
                ])
                ->creatable(limit: 6)
                ->removable()
                ->vertical(),
        ])->icon('shield-check');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Включено
    // -------------------------------------------------------------------------
    private function tabIncluded(): Tab
    {
        return Tab::make('Включено', [
            Text::make('Заголовок H2', 'included_h2')
                ->default('Входит в стоимость любого сайта')
                ->required(),

            Textarea::make('Описание', 'included_desc')
                ->default('Каждый проект получает базовую внутреннюю оптимизацию и адаптив. Вам не придётся доплачивать за то, что должно работать по умолчанию.'),

            Divider::make('Пункты списка'),

            Json::make('Пункты', 'included_items')
                ->fields([
                    Text::make('Текст', 'text'),
                ])
                ->default([
                    ['text' => 'Запись необходимых метатегов'],
                    ['text' => 'Ускорение загрузки сайта'],
                    ['text' => 'Микроразметка schema.org'],
                    ['text' => 'Разметка Open Graph'],
                    ['text' => 'Адаптив под телефоны и планшеты'],
                    ['text' => 'Обучение работе с сайтом'],
                ])
                ->creatable(limit: 12)
                ->removable()
                ->vertical(),
        ])->icon('check-circle');
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
            Textarea::make('Скрипт', 'script')->unescape(),
        ])->icon('magnifying-glass');
    }

    protected function components(): iterable
    {
        yield $this->form();
    }
}
