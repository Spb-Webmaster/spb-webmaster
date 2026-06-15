import './bootstrap';
// IMask to add input masks support
import IMask from 'imask';
window.IMask = IMask;

import { mzSelect } from './include/select/mz-select';
mzSelect();




// import styles bundle
import 'swiper/css/bundle';


import './script';
import './include/fancybox/fancybox';
import {callbackForm} from './include/form/callback-form';
import {cabinetMessageDeleteInit} from './include/fancybox/cabinet_message';

callbackForm();
cabinetMessageDeleteInit();
