import { Fancybox } from "@fancyapps/ui/dist/fancybox/";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
import {scrollCabinetMessages} from "./cabinet_message";


/*Fancybox.bind('[data-fancybox]', {

    zoomEffect: false,
    hideScrollbar: false, // Оставляем скроллбар видимым
    dragToClose: false,
    clickOutside: false,
    preventViewportChange: true, // Добавьте эту опцию, чтобы предотвратить смену положения просмотра
    userSelectableContent: true, // Разрешаем выделять текст внутри модального окна
    touch: false,

});*/

Fancybox.bind('[data-fancybox="gallery"]', {
    animated: true,
    dragToClose: true,
});

// Открытие обложки проекта в галерее — только на мобильных
document.addEventListener('click', function (e) {
    if (window.innerWidth > 768) return;
    var cover = e.target.closest('.w-card-cover');
    if (!cover) return;

    var allCovers = Array.from(
        document.querySelectorAll('#w-cards .w-card:not([style*="display: none"]) .w-card-cover')
    );

    var items = allCovers.map(function (c) {
        var img = c.querySelector('.w-cover-img');
        return { src: img ? img.src : '', type: 'image' };
    }).filter(function (item) { return item.src; });

    var startIndex = allCovers.indexOf(cover);

    Fancybox.show(items, {
        animated: true,
        dragToClose: true,
        startIndex: startIndex < 0 ? 0 : startIndex,
    });
});

/** получаем csrf **/
const metaElements = document.querySelectorAll('meta[name="csrf-token"]');
const csrf = metaElements.length > 0 ? metaElements[0].content : "";
/** получаем csrf **/


const fancyWindows = Array.from(document.querySelectorAll('.open-fancybox'))

/** открыть open-fancybox **/
for (let fancyWindow of fancyWindows) {
    fancyWindow.addEventListener('click', openFancyBox)
}


async  function openFancyBox(e) {
    e.preventDefault()
    try {

        /** в случае клика по-внутреннему тэгу, получим data-form в любом случае **/
        const parentEl = e.target.closest('.open-fancybox');
        const formTemplate = parentEl.dataset.form; /** название шаблона для blade **/
        const transferData = parentEl.dataset.transfer; /** дополнительные данные в json для blade **/
        const template = { template: formTemplate, author: '@AxeldMaster', data: transferData };

        console.log(template)

        const response = await fetch('/fancybox-ajax', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrf
            },
            body: JSON.stringify(template),
        });

        if (!response.ok) {
            console.error(`Error: ${response.status}`);
        }
        // const data = await response.json();
        const data = await response.text(); // Важно использовать .text(), а не .json()

        Fancybox.show([{
            html: data,

        }],
            {
            dragToClose: false,       // Перетаскивание не закроет модалку
            closeButton: true,         // Крестик закрытия включен
            backdropClick: 'close'    // закрыть нажатием в свободную область
        },
            );


        scrollCabinetMessages(); // скроллим до последнего сообщения

    } catch (err) {
        console.error('Ошибка AJAX:', err.message);
        alert('Ошибка при получении данных');
    }
}
