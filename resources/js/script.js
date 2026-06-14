import { imask } from './include/imask';
// import { close_flash } from './include/flash';
/*import {tooltip} from './include/tooltip';*/

// import {yandex_map_object} from "./include/site/yandex_map";

// import {swiper} from "./include/site/swiper";
import {navDrawer} from "./include/site/nav-drawer";
import {mzSelect} from "./include/select/mz-select";
// import {removeErrors} from "./include/fancybox/form/removeErrors";
import {flash_message} from "./include/flash_message/flash_message";

// import {datepicker_accountant_ticket_date, datepicker_date_birthday} from "./include/datepicker/datepicker";
// import {trix} from "./include/editor/trix";
// import {faqAccordion} from "./include/site/faq";


document.addEventListener('DOMContentLoaded', function () {
    imask() // маска для полей .imask
    // close_flash() // старый flash: селекторы .app_add_hm/.flashMassege в текущих views не найдены
   /* tooltip() // tooltip */
    // yandex_map_object('43db27ba-be61-4e84-b139-ff37ad4802b8') // #JFormFieldMap в текущих views не найден
    // swiper() // .block3-swiper/.schedule-swiper в текущих views не найдены
    navDrawer()
    mzSelect()
    // removeErrors() // старые .app_input_group/.app_select_group в текущей разметке не используются
    flash_message() // закрытие flash-сообщений
    // datepicker_date_birthday() // input[name="date_birthday"] в текущих views не найден
    // datepicker_accountant_ticket_date() // input[name="accountant_ticket_date"] в текущих views не найден
    // trix() // trix-editor в текущих views не найден
    // faqAccordion() // .faq-list в текущих views не найден
});