export function imask() {
    document.querySelectorAll('.imask').forEach(function (phone) {

        var m = IMask(phone, {
            mask: [
                // Российский: +7 (XXX) XXX-XX-XX
                { mask: '+{7}(000)000-00-00', startsWith: '7' },
                // Зарубежный: + до 15 цифр (стандарт E.164)
                { mask: '+000000000000000',   startsWith: '' }
            ],
            dispatch: function (appended, dynamicMasked) {
                var digits = (dynamicMasked.value + appended).replace(/\D/g, '');
                // 7... и 8... — оба российских формата
                return (digits.startsWith('7') || digits.startsWith('8'))
                    ? dynamicMasked.compiledMasks[0]
                    : dynamicMasked.compiledMasks[1];
            }
        });

        // Ввод «8» с пустого поля → сразу переходим в российский формат
        phone.addEventListener('keydown', function (e) {
            if (e.key === '8' && !phone.value) {
                e.preventDefault();
                m.value = '+7(';
                phone.setSelectionRange(phone.value.length, phone.value.length);
            }
        });

        // Вставка 11-значного номера в формате 7XXXXXXXXXX или 8XXXXXXXXXX
        phone.addEventListener('paste', function (e) {
            var text   = (e.clipboardData || window.clipboardData).getData('text');
            var digits = text.replace(/\D/g, '');
            if (digits.length === 11 && (digits[0] === '7' || digits[0] === '8')) {
                e.preventDefault();
                var loc = digits.slice(1); // 10 локальных цифр
                m.value = '+7(' + loc.slice(0, 3) + ')' + loc.slice(3, 6) + '-' + loc.slice(6, 8) + '-' + loc.slice(8, 10);
            }
        });
    });
}
