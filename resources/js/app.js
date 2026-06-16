import './bootstrap';
import IMask from 'imask';
window.IMask = IMask;

import { mzSelect } from './include/select/mz-select';
mzSelect();

import './script';
import {callbackForm} from './include/form/callback-form';
import {cabinetMessageDeleteInit} from './include/fancybox/cabinet_message';

callbackForm();
cabinetMessageDeleteInit();

// Fancybox загружается лениво — только если на странице есть галерея или модальные окна
window.addEventListener('load', function () {
    if (document.querySelector('[data-fancybox], .open-fancybox, .w-card-cover')) {
        import('./include/fancybox/fancybox');
    }
});
