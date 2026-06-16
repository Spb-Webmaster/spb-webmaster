<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\Pages;

use App\Models\Setting;
use Illuminate\Http\Request;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Crud\JsonResponse;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Support\Attributes\AsyncMethod;
use MoonShine\Support\Enums\ToastType;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Divider;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Phone;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class SettingPage extends Page
{
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Константы';
    }

    private function getSetting(): Setting
    {
        return Setting::getGroup('settings');
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
                        Tab::make('Константы', [
                            Divider::make('Общие контактные данные сайта'),
                            Phone::make('Телефон', 'phone'),
                            Email::make('E-mail', 'email'),
                            Textarea::make('Копирайт', 'copy'),
                            Text::make('Город', 'city'),
                            Text::make('Телеграм', 'telegram'),
                        ])->icon('phone'),

                        Tab::make('Метрика', [
                            Divider::make('Яндекс.Метрика'),
                            Textarea::make('Код счётчика', 'yandex_metrika')
                                ->hint('Вставьте код счётчика Яндекс.Метрики целиком, включая тег script'),
                        ])->icon('chart-pie'),

                        Tab::make('E-mail адреса', [
                            Divider::make('Получатели писем с форм сайта'),
                            Json::make('E-mail адреса', 'emails')->fields([
                                Text::make('E-mail', 'email')
                                    ->hint('Например: manager@domain.ru'),
                            ])->vertical()->creatable()->removable(),
                        ])->icon('envelope'),
                    ]),
                ]),

            ])
            ->submit('Сохранить', ['class' => 'btn-primary']);
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        yield $this->form();
    }
}
