@extends('layouts.layout')
<x-seo.meta
    title="{{ $c['metatitle'] ?? 'Контакты — SPB-WEBMASTER' }}"
    description="{{ $c['description'] ?? 'Оставьте заявку или позвоните — свяжемся в течение рабочего дня, бесплатно оценим объём и предложим решение под ваш бюджет.' }}"
    keywords="{{ $c['keywords'] ?? 'контакты веб-студия, заказать сайт Санкт-Петербург, разработка сайтов контакты' }}"
/>


@section('content')

{{-- INFO --}}
<section class="s-c-info">
  <div class="c-info-deco1"></div>
  <div class="c-info-deco2"></div>
  <div class="pg-inner">
    <nav class="c-breadcrumb" aria-label="Breadcrumb">
      @foreach (Breadcrumbs::generate('contacts') as $crumb)
        @if (!$loop->last)<a href="{{ $crumb->url }}">{{ $crumb->title }}</a> &nbsp;/&nbsp;
        @else{{ $crumb->title }}@endif
      @endforeach
    </nav>
    <div class="c-grid">

      {{-- Левая: заголовок + цифры --}}
      <div>
        <h1 class="c-h1">Расскажите<br>о <span class="text-gradient">{{ $c['h1_gradient'] ?? 'проекте' }}</span></h1>
        <p class="c-subtitle">{{ $c['subtitle'] ?? 'Оставьте заявку или позвоните — свяжемся в течение рабочего дня, бесплатно оценим объём и предложим решение под ваш бюджет.' }}</p>
        <div class="c-pledges">
          @foreach($pledges as $pledge)
          <div>
            <div class="c-pledge-val">{{ $pledge['value'] }}</div>
            <div class="c-pledge-label">{{ $pledge['label'] }}</div>
          </div>
          @endforeach
        </div>
      </div>

      {{-- Правая: карточки контактов --}}
      <div class="c-cards">
        <a href="setting-phone" class="c-card">
          <span class="c-card-icon">☎</span>
          <span>
            <span class="c-card-lbl">Телефон</span>
            <span class="c-card-val">setting-phone</span>
          </span>
        </a>
        <a href="{{ 'mailto:' . ($c['email'] ?? 'setting-email') }}" class="c-card">
          <span class="c-card-icon">✉</span>
          <span>
            <span class="c-card-lbl">Почта</span>
            <span class="c-card-val">setting-email</span>
          </span>
        </a>
        <a href="setting-telegram" class="c-card">
          <span class="c-card-icon">✆</span>
          <span>
            <span class="c-card-lbl">Мессенджеры</span>
            <span class="c-card-val">{{ $c['messenger_text'] ?? 'Telegram · WhatsApp' }}</span>
          </span>
        </a>
      </div>

    </div>
  </div>
</section>

{{-- ФОРМА --}}
<section class="s-c-form">
  <div class="c-form-deco"></div>
  <div class="c-form-wrap">
    <div class="c-form-card">

      <div id="c-form-wrapper">
        <h2 class="c-form-h2">Заявка на расчёт</h2>
        <form id="c-contact-form" class="c-form">
          <label class="c-form-field">Ваше имя
            <input type="text" name="name" placeholder="Иван" class="c-form-input" required>
          </label>
          <label class="c-form-field">Телефон
            <input type="tel" name="phone" placeholder="+7 или +44..." class="c-form-input imask" required>
          </label>
          <div class="c-form-field">Тип сайта
            <div class="mz-select" data-mz-select>
              <select name="type">
                <option value="" disabled selected>Выберите тип сайта</option>
                <option value="business-card">Сайт-визитка</option>
                <option value="landing">Лендинг</option>
                <option value="catalog">Сайт-каталог</option>
                <option value="shop">Интернет-магазин</option>
                <option value="unknown">Пока не определился</option>
              </select>
            </div>
          </div>
          <label class="c-form-field">Комментарий
            <textarea name="msg" placeholder="Коротко о задаче" rows="3" class="c-form-input"></textarea>
          </label>
          <button type="submit" class="c-form-btn">Отправить заявку</button>
          <p class="c-form-note">Нажимая кнопку, вы соглашаетесь с обработкой персональных данных.</p>
        </form>
      </div>

      <div id="c-success-wrapper" class="c-success">
        <div class="c-success-icon">✓</div>
        <h2 class="c-success-h2">Заявка отправлена</h2>
        <p class="c-success-p">Спасибо! Мы свяжемся с вами в течение рабочего дня по указанному телефону.</p>
        <button id="c-form-reset" class="c-success-reset">Отправить ещё одну</button>
      </div>

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var header = document.getElementById('site-header');
  if (header) {
    var onScroll = function () {
      header.style.boxShadow = window.scrollY > 8 ? '0 6px 24px rgba(25,21,19,0.09)' : 'none';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  var burger = document.getElementById('spb-burger');
  var mobileMenu = document.getElementById('spb-mobile-menu');
  if (burger && mobileMenu) {
    burger.addEventListener('click', function () {
      var isOpen = mobileMenu.style.maxHeight && mobileMenu.style.maxHeight !== '0px';
      if (isOpen) {
        mobileMenu.style.maxHeight = '0px';
        mobileMenu.style.padding = '0';
      } else {
        mobileMenu.style.display = 'flex';
        mobileMenu.style.maxHeight = '600px';
        mobileMenu.style.padding = '0 0 8px';
      }
    });
    mobileMenu.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        mobileMenu.style.maxHeight = '0px';
        mobileMenu.style.padding = '0';
      });
    });
  }

  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!reduce) {
    var sections = Array.from(document.querySelectorAll('section'));
    sections.forEach(function (s) {
      s.style.opacity = '0';
      s.style.transform = 'translateY(28px)';
      s.style.transition = 'opacity .7s ease, transform .7s ease';
    });
    var reveal = function (s) { s.dataset._shown = '1'; s.style.opacity = '1'; s.style.transform = 'none'; };
    if (sections[0]) reveal(sections[0]);
    var check = function () {
      var vh = window.innerHeight || document.documentElement.clientHeight;
      var remaining = false;
      sections.forEach(function (s) {
        if (s.dataset._shown) return;
        var r = s.getBoundingClientRect();
        if (r.top < vh * 0.9 && r.bottom > 0) reveal(s);
        else remaining = true;
      });
      if (!remaining) {
        window.removeEventListener('scroll', onRevealScroll, true);
        window.removeEventListener('resize', check);
      }
    };
    var onRevealScroll = function () { check(); };
    window.addEventListener('scroll', onRevealScroll, true);
    window.addEventListener('resize', check);
    check();
    setTimeout(function () { sections.forEach(reveal); }, 4500);
  }
});

(function () {
  var form       = document.getElementById('c-contact-form');
  var formWrap   = document.getElementById('c-form-wrapper');
  var successWrap = document.getElementById('c-success-wrapper');
  var resetBtn   = document.getElementById('c-form-reset');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var name  = form.querySelector('input[name="name"]').value.trim();
    var phone = form.querySelector('input[name="phone"]').value.trim();
    var type  = form.querySelector('select[name="type"]').value;
    var msg   = form.querySelector('textarea[name="msg"]').value.trim();
    if (!name || !phone) return;
    var btn = form.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.textContent = 'Отправляем...';
    window.axios.post('/call-me-blue', { name: name, phone: phone, type: type, msg: msg })
      .then(function (response) {
        if (response.data.response === 'ok') {
          formWrap.style.display = 'none';
          successWrap.style.display = 'block';
        }
      })
      .catch(function () {
        btn.disabled = false;
        btn.textContent = 'Отправить заявку';
      });
  });

  if (resetBtn) {
    resetBtn.addEventListener('click', function () {
      form.reset();
      successWrap.style.display = 'none';
      formWrap.style.display = 'block';
    });
  }
})();
</script>
@endpush
