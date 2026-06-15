@props([
    'variant' => 'home',
    'formId' => null,
    'wrapperId' => null,
    'responseId' => null,
    'endpoint' => '/call-me-blue',
    'title' => null,
    'subtitle' => null,
    'submit' => null,
    'note' => 'Нажимая кнопку, вы соглашаетесь с обработкой персональных данных.',
    'showType' => true,
    'showMessage' => false,
    'namePlaceholder' => null,
    'phonePlaceholder' => null,
    'responseTitle' => 'Заявка отправлена',
    'responseText' => 'Спасибо! Мы свяжемся с вами в течение рабочего дня.',
    'typeOptions' => [
        ['value' => 'Сайт-визитка', 'label' => 'Сайт-визитка'],
        ['value' => 'Лендинг', 'label' => 'Лендинг'],
        ['value' => 'Сайт-каталог', 'label' => 'Сайт-каталог'],
        ['value' => 'Интернет-магазин', 'label' => 'Интернет-магазин'],
        ['value' => 'Пока не определился', 'label' => 'Пока не определился'],
    ],
])

@php
    $isContacts = $variant === 'contacts';
    $isModal = $variant === 'modal';

    $formId ??= match ($variant) {
        'contacts' => 'c-contact-form',
        'modal' => 'callback-modal-form',
        default => 'spb-contact-form',
    };

    $wrapperId ??= match ($variant) {
        'contacts' => 'c-form-wrapper',
        'modal' => 'callback-modal-form-wrapper',
        default => 'spb-form-wrapper',
    };

    $responseId ??= match ($variant) {
        'contacts' => 'c-success-wrapper',
        'modal' => 'callback-modal-response',
        default => 'spb-success-wrapper',
    };

    $title ??= match ($variant) {
        'contacts' => 'Заявка на расчёт',
        'modal' => 'Получить консультацию',
        default => 'Бесплатный расчёт проекта',
    };

    $subtitle ??= 'Оставьте имя и телефон — свяжемся в течение рабочего дня.';
    $submit ??= $isModal ? 'Отправить' : 'Отправить заявку';
    $namePlaceholder ??= $isContacts ? 'Иван' : 'Ваше имя';
    $phonePlaceholder ??= $isContacts ? '+7 ...' : 'Телефон';

    $formClass = match ($variant) {
        'contacts' => 'c-form',
        'modal' => 'callback-form-modal',
        default => 'cta-form',
    };

    $inputClass = $isContacts ? 'c-form-input' : 'spb-form-input';
    $errorClass = $isContacts ? 'c-form-error' : 'spb-form-error';
    $buttonClass = $isContacts ? 'c-form-btn' : 'spb-form-btn';
    $noteClass = $isContacts ? 'c-form-note' : ($isModal ? 'callback-form-modal__note' : 'cta-form-note');
@endphp

@if($isModal)
    <div class="modal-form-container mini app_form_modal" data-callback-form-shell>
        <div class="modal_padding">
            <x-form.form-response
                variant="modal"
                :id="$responseId"
                title="Спасибо"
                text="Мы получили вашу заявку, наш менеджер свяжется с вами в ближайшее время"
            />

            <div class="app_modal" id="{{ $wrapperId }}" data-callback-content>
                <div class="form_title">
                    <div class="form_title__h1">{{ $title }}</div>
                    <div class="form_title__h2">{{ $subtitle }}</div>
                </div>

                <form
                    id="{{ $formId }}"
                    class="{{ $formClass }}"
                    data-callback-form
                    data-endpoint="{{ $endpoint }}"
                    novalidate
                >
                    <input type="hidden" name="_form_time" value="{{ now()->timestamp }}">

                    <div class="app_form_data callback-form-modal__fields">
                        <div class="app_input_group">
                            <input type="text" name="name" placeholder="{{ $namePlaceholder }}" class="app_input_name {{ $inputClass }}" required>
                            <span class="app_input_error {{ $errorClass }}" data-callback-error="name"></span>
                        </div>
                        <div class="app_input_group">
                            <input type="tel" name="phone" placeholder="{{ $phonePlaceholder }}" class="app_input_name {{ $inputClass }} imask" required>
                            <span class="app_input_error {{ $errorClass }}" data-callback-error="phone"></span>
                        </div>
                    </div>

                    <button type="submit" class="{{ $buttonClass }}">{{ $submit }}</button>
                    <p class="{{ $noteClass }}">{{ $note }}</p>
                </form>
            </div>
        </div>

        <x-form.form-loader class="callback-form__loader" />
    </div>
@else
    <div class="callback-form callback-form--{{ $variant }}" data-callback-form-shell>
        <div id="{{ $wrapperId }}" data-callback-content>
            @if($isContacts)
                <h2 class="c-form-h2">{{ $title }}</h2>
            @endif

            <form
                id="{{ $formId }}"
                class="{{ $formClass }}"
                data-callback-form
                data-endpoint="{{ $endpoint }}"
                novalidate
            >
                <input type="hidden" name="_form_time" value="{{ now()->timestamp }}">

                @unless($isContacts)
                    <div class="cta-form-title">{{ $title }}</div>
                @endunless

                @if($isContacts)
                    <label class="c-form-field">Ваше имя
                        <input type="text" name="name" placeholder="{{ $namePlaceholder }}" class="{{ $inputClass }}" required>
                        <span class="{{ $errorClass }}" data-callback-error="name"></span>
                    </label>
                    <label class="c-form-field">Телефон
                        <input type="tel" name="phone" placeholder="{{ $phonePlaceholder }}" class="{{ $inputClass }} imask" required>
                        <span class="{{ $errorClass }}" data-callback-error="phone"></span>
                    </label>
                @else
                    <div class="spb-input-wrap">
                        <input type="text" name="name" placeholder="{{ $namePlaceholder }}" class="{{ $inputClass }}" required>
                        <span class="{{ $errorClass }}" data-callback-error="name"></span>
                    </div>
                    <div class="spb-input-wrap">
                        <input type="tel" name="phone" placeholder="{{ $phonePlaceholder }}" class="{{ $inputClass }} imask" required>
                        <span class="{{ $errorClass }}" data-callback-error="phone"></span>
                    </div>
                @endif

                @if($showType)
                    @if($isContacts)
                        <div class="c-form-field">Тип сайта
                            <div class="mz-select" data-mz-select>
                                <select name="type">
                                    <option value="" disabled selected>Выберите тип сайта</option>
                                    @foreach($typeOptions as $option)
                                        <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @else
                        <div class="mz-select" data-mz-select>
                            <select name="type">
                                <option value="" disabled selected>Тип сайта</option>
                                @foreach($typeOptions as $option)
                                    <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                @endif

                @if($showMessage)
                    <label class="c-form-field">Комментарий
                        <textarea name="msg" placeholder="Коротко о задаче" rows="3" class="{{ $inputClass }}"></textarea>
                    </label>
                @endif

                <button type="submit" class="{{ $buttonClass }}">{{ $submit }}</button>
                <p class="{{ $noteClass }}">{{ $note }}</p>
            </form>
        </div>

        <x-form.form-response
            :variant="$variant"
            :id="$responseId"
            :title="$responseTitle"
            :text="$responseText"
        />

        <x-form.form-loader class="callback-form__loader" />
    </div>
@endif
