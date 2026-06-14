<?php

use Diglactic\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('guarantees', function ($trail) {
    $trail->parent('home');
    $trail->push('Гарантии', route('guarantees'));
});

Breadcrumbs::for('works', function ($trail) {
    $trail->parent('home');
    $trail->push('Наши работы', route('works'));
});

Breadcrumbs::for('contacts', function ($trail) {
    $trail->parent('home');
    $trail->push('Контакты', route('contacts'));
});
