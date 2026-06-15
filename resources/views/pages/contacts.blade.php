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
        <a href="tel:+{{ phone($settings['phone'] ?? '') }}" class="c-card">
          <span class="c-card-icon">☎</span>
          <span>
            <span class="c-card-lbl">Телефон</span>
            <span class="c-card-val">{{ format_phone(phone($settings['phone'] ?? '')) }}</span>
          </span>
        </a>
        <a href="mailto:{{ $settings['email'] ?? '' }}" class="c-card">
          <span class="c-card-icon">✉</span>
          <span>
            <span class="c-card-lbl">Почта</span>
            <span class="c-card-val">{{ $settings['email'] ?? '' }}</span>
          </span>
        </a>
        <a href="{{ $settings['telegram'] ?? '#' }}" class="c-card">
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
      <x-form.callback-form
          variant="contacts"
          form-id="c-contact-form"
          wrapper-id="c-form-wrapper"
          response-id="c-success-wrapper"
          reset-id="c-form-reset"
          title="Заявка на расчёт"
          :show-message="true"
          response-title="Заявка отправлена"
          response-text="Спасибо! Мы свяжемся с вами в течение рабочего дня по указанному телефону."
      />

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
</script>
@endpush
