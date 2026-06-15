import { imask } from '../imask';

const FORM_SELECTOR = 'form[data-callback-form]';
const FIELD_SELECTOR = 'input[name], textarea[name], select[name]';

function findShell(form) {
    return form.closest('[data-callback-form-shell]');
}

function findContent(form) {
    const shell = findShell(form);
    return shell?.querySelector('[data-callback-content]') ?? form.closest('[data-callback-content]');
}

function findResponse(form) {
    const shell = findShell(form);
    return shell?.querySelector('[data-callback-response]');
}

function findLoader(form) {
    const shell = findShell(form);
    return form.querySelector('.app_loader') ?? shell?.querySelector('.app_loader');
}

function findSubmit(form) {
    return form.querySelector('button[type="submit"]');
}

function findField(form, name) {
    return form.querySelector(`[name="${CSS.escape(name)}"]`);
}

function findError(form, name) {
    return form.querySelector(`[data-callback-error="${CSS.escape(name)}"]`);
}

function setFieldError(form, name, message) {
    const field = findField(form, name);
    const error = findError(form, name);

    field?.classList.add('_error');

    if (error) {
        error.textContent = message;
    }
}

function clearFieldError(form, name) {
    const field = findField(form, name);
    const error = findError(form, name);

    field?.classList.remove('_error');

    if (error) {
        error.textContent = '';
    }
}

function clearErrors(form) {
    form.querySelectorAll(FIELD_SELECTOR).forEach((field) => {
        if (field.name) {
            clearFieldError(form, field.name);
        }
    });
}

function validate(form) {
    let valid = true;
    const name = findField(form, 'name')?.value.trim() ?? '';
    const phone = findField(form, 'phone')?.value.trim() ?? '';

    if (name.length < 2) {
        setFieldError(form, 'name', 'Введите имя (минимум 2 символа).');
        valid = false;
    } else {
        clearFieldError(form, 'name');
    }

    if (phone.replace(/\D/g, '').length < 7) {
        setFieldError(form, 'phone', 'Введите корректный номер телефона.');
        valid = false;
    } else {
        clearFieldError(form, 'phone');
    }

    return valid;
}

function collectPayload(form) {
    const payload = {};
    const formData = new FormData(form);

    formData.forEach((value, key) => {
        payload[key] = typeof value === 'string' ? value.trim() : value;
    });

    return payload;
}

function setLoading(form, isLoading) {
    const loader = findLoader(form);
    const submit = findSubmit(form);

    loader?.classList.toggle('active', isLoading);

    if (submit) {
        submit.disabled = isLoading;
    }
}

function showResponse(form) {
    const content = findContent(form);
    const response = findResponse(form);

    form.dataset.submitted = 'true';

    if (content) {
        content.style.display = 'none';
    }

    if (response) {
        response.classList.add('active');
        response.style.display = 'block';
    }
}

async function handleSubmit(event) {
    const form = event.target.closest(FORM_SELECTOR);

    if (!form) {
        return;
    }

    event.preventDefault();

    if (form.dataset.submitted === 'true') {
        return;
    }

    if (!validate(form)) {
        return;
    }

    const endpoint = form.dataset.endpoint || '/call-me-blue';
    const minDelay = new Promise((resolve) => setTimeout(resolve, 1000));

    setLoading(form, true);

    try {
        const [response] = await Promise.all([
            window.axios.post(endpoint, collectPayload(form)),
            minDelay,
        ]);

        setLoading(form, false);

        if (response?.data?.response === 'ok') {
            showResponse(form);
            return;
        }

        setFieldError(form, 'phone', 'Ошибка отправки. Попробуйте позже.');
    } catch (error) {
        setLoading(form, false);

        if (error.response?.status === 422) {
            const errors = error.response.data.errors || {};
            clearErrors(form);

            Object.keys(errors).forEach((name) => {
                setFieldError(form, name, errors[name][0]);
            });

            return;
        }

        setFieldError(form, 'phone', 'Ошибка отправки. Пожалуйста, попробуйте позже.');
    }
}

function handleInput(event) {
    const field = event.target.closest(FIELD_SELECTOR);
    const form = field?.closest(FORM_SELECTOR);

    if (form && field.name) {
        clearFieldError(form, field.name);
    }
}

function handleFocus(event) {
    const field = event.target.closest(FIELD_SELECTOR);
    const form = field?.closest(FORM_SELECTOR);

    if (event.target.matches?.('.imask')) {
        imask(event.target);
    }

    if (form && field.name) {
        clearFieldError(form, field.name);
    }
}

export function callbackForm() {
    imask();
    document.addEventListener('submit', handleSubmit);
    document.addEventListener('input', handleInput);
    document.addEventListener('change', handleInput);
    document.addEventListener('focusin', handleFocus);
}
