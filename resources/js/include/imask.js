function findMaskInputs(root = document) {
    if (root instanceof Element && root.matches('.imask')) {
        return [root];
    }

    return Array.from(root.querySelectorAll?.('.imask') ?? []);
}

export function imask(root = document) {
    findMaskInputs(root).forEach(function (phone) {
        if (phone.dataset.imaskReady === '1') {
            return;
        }

        phone.dataset.imaskReady = '1';

        var m = IMask(phone, {
            mask: [
                { mask: '+{7}(000)000-00-00', startsWith: '7' },
                { mask: '+000000000000000', startsWith: '' }
            ],
            dispatch: function (appended, dynamicMasked) {
                var digits = (dynamicMasked.value + appended).replace(/\D/g, '');

                return (digits.startsWith('7') || digits.startsWith('8'))
                    ? dynamicMasked.compiledMasks[0]
                    : dynamicMasked.compiledMasks[1];
            }
        });

        phone.addEventListener('keydown', function (e) {
            if (e.key === '8' && !phone.value) {
                e.preventDefault();
                m.value = '+7(';
                phone.setSelectionRange(phone.value.length, phone.value.length);
            }
        });

        phone.addEventListener('paste', function (e) {
            var text = (e.clipboardData || window.clipboardData).getData('text');
            var digits = text.replace(/\D/g, '');

            if (digits.length === 11 && (digits[0] === '7' || digits[0] === '8')) {
                e.preventDefault();
                var local = digits.slice(1);
                m.value = '+7(' + local.slice(0, 3) + ')' + local.slice(3, 6) + '-' + local.slice(6, 8) + '-' + local.slice(8, 10);
            }
        });
    });
}
