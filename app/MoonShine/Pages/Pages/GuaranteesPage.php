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

class GuaranteesPage extends Page
{
    public function getTitle(): string
    {
        return 'Гарантии';
    }

    private function getSetting(): Setting
    {
        return Setting::getGroup('guarantees');
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
                        $this->tabSteps(),
                        $this->tabCoverage(),
                        $this->tabCondition(),
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
            Text::make('Подзаголовок H1 (градиент)', 'hero_h1_gradient')
                ->default('12 месяцев')
                ->hint('Эта часть отображается оранжевым градиентом'),

            Text::make('Окончание H1', 'hero_h1_tail')
                ->default('гарантии на каждый проект'),

            Textarea::make('Подзаголовок', 'hero_subtitle')
                ->default('Мы отвечаем за работу всего, что создаём. Если в течение года любая функция перестанет работать по нашей вине — исправим бесплатно. Без споров и скрытых условий.'),

            Divider::make('Цифры-статистика'),

            Json::make('Статистика', 'stats')
                ->fields([
                    Text::make('Значение', 'value'),
                    Text::make('Подпись', 'label'),
                ])
                ->default([
                    ['value' => '12',   'label' => 'месяцев гарантии на работу'],
                    ['value' => '0 ₽',  'label' => 'за исправление наших ошибок'],
                    ['value' => '100%', 'label' => 'проектов сдаём по договору'],
                ])
                ->creatable(limit: 4)
                ->removable()
                ->vertical(),
        ])->icon('shield-check');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Схема работы
    // -------------------------------------------------------------------------
    private function tabSteps(): Tab
    {
        return Tab::make('Схема', [
            Json::make('Шаги', 'steps')
                ->fields([
                    Text::make('Заголовок', 'title'),
                    Textarea::make('Описание', 'desc'),
                ])
                ->default([
                    ['title' => 'Создаём с гарантией',         'desc' => 'Сдаём готовый проект и закрепляем в договоре гарантию 12 месяцев на работу всех функций.'],
                    ['title' => 'Что-то перестало работать',    'desc' => 'Заметили, что функция, форма или интеграция работает не так, как при сдаче — сообщаете нам.'],
                    ['title' => 'Бесплатно исправляем',         'desc' => 'Находим причину и устраняем ошибки без доплат — в рамках действующей гарантии.'],
                ])
                ->creatable(limit: 5)
                ->removable()
                ->vertical(),
        ])->icon('list-bullet');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Покрытие / Исключения
    // -------------------------------------------------------------------------
    private function tabCoverage(): Tab
    {
        return Tab::make('Покрытие', [
            Divider::make('Что покрывает гарантия'),

            Json::make('Покрывает', 'covered')
                ->fields([
                    Text::make('Пункт', 'text'),
                ])
                ->default([
                    ['text' => 'Корректная работа всех функций, форм и кнопок'],
                    ['text' => 'Отображение сайта в современных браузерах'],
                    ['text' => 'Работа интеграций, настроенных нашей студией'],
                    ['text' => 'Адаптивность и целостность вёрстки'],
                    ['text' => 'Исправление технических ошибок по нашей вине'],
                ])
                ->creatable(limit: 8)
                ->removable()
                ->vertical(),

            Divider::make('Когда гарантия не действует'),

            Json::make('Не действует', 'voided')
                ->fields([
                    Text::make('Пункт', 'text'),
                ])
                ->default([
                    ['text' => 'Внесены изменения в исходный код сайта'],
                    ['text' => 'Правки выполнял сторонний разработчик'],
                    ['text' => 'Файлы на сервере изменены вручную'],
                    ['text' => 'Установлены посторонние скрипты или плагины'],
                    ['text' => 'Сбои хостинга или домена не по нашей вине'],
                ])
                ->creatable(limit: 8)
                ->removable()
                ->vertical(),
        ])->icon('check-circle');
    }

    // -------------------------------------------------------------------------
    // Вкладка: Важное условие + CTA
    // -------------------------------------------------------------------------
    private function tabCondition(): Tab
    {
        return Tab::make('Условие', [
            Divider::make('Блок «Работайте через админ-панель»'),

            Text::make('Заголовок H2', 'cond_h2')
                ->default('Работайте через админ-панель'),

            Textarea::make('Описание', 'cond_p')
                ->default('Гарантия действует, пока сайт остаётся в том виде, в котором мы его сдали. Управляйте контентом через удобную админ-панель — все нужные правки доступны там, без вмешательства в код.'),

            Divider::make('Блок CTA'),

            Text::make('Заголовок CTA', 'cta_h2')
                ->default('Хотите проект с гарантией?'),

            Text::make('Текст CTA', 'cta_p')
                ->default('Все условия гарантии и сроки фиксируем в договоре до старта работ.'),
        ])->icon('document-text');
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
