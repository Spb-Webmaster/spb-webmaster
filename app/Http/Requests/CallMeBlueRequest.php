<?php

namespace App\Http\Requests;

use App\Rules\FormTimestamp;
use Illuminate\Foundation\Http\FormRequest;

class CallMeBlueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'min:2', 'max:100'],
            'phone'       => ['required', 'string', 'min:6', 'max:30'],
            'type'        => ['nullable', 'string', 'max:100'],
            'msg'         => ['nullable', 'string', 'max:2000'],
            '_form_time'  => ['required', new FormTimestamp],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'Необходимо ввести имя.',
            'name.min'            => 'Минимальная длина имени — :min символа.',
            'name.max'            => 'Максимальная длина имени — :max символов.',
            'phone.required'      => 'Необходимо ввести номер телефона.',
            'phone.min'           => 'Минимальная длина телефона — :min символов.',
            'phone.max'           => 'Максимальная длина телефона — :max символов.',
            'type.max'            => 'Максимальная длина поля «Тип» — :max символов.',
            'msg.max'             => 'Максимальная длина сообщения — :max символов.',
            '_form_time.required' => 'Форма заполнена некорректно. Обновите страницу.',
        ];
    }
}
