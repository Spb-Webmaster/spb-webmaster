@extends('layouts.layout')
<x-seo.meta
    title="{{ $home['metatitle'] ?? '' }}"
    description="{{ $home['description'] ?? '' }}"
    keywords="{{ $home['keywords'] ?? '' }}"
/>


@section('content')

{{-- HERO --}}
<section class="s-hero">
  <div class="pg-inner">
    <div class="hero-grid">

      {{-- Левая колонка --}}
      <div class="hero-left">
        <div class="hero-badge">
          <span class="hero-badge-dot"></span>
          {{ $home['hero_badge'] ?? 'Онлайн-студия разработки сайтов' }}
        </div>
        <h1 class="hero-h1">
          {!! $home['hero_h1'] ?? 'Сайт под <span class="text-gradient">ключ</span> для вашего дела' !!}
        </h1>
        <p class="hero-subtitle">
          {{ $home['hero_subtitle'] ?? 'Оригинальный дизайн, фиксированная цена и базовое SEO в каждом проекте. Делаем сайты для частных специалистов и небольших компаний — от визитки до магазина.' }}
        </p>
        <div class="hero-btns">
          <a href="#cta" class="hero-btn-cta">Рассчитать стоимость</a>
          <a href="#services" class="spb-hero-btn-outline">Смотреть услуги</a>
        </div>
      </div>

      {{-- Правая колонка: браузерный макет --}}
      <div class="hero-right">
        <div class="hero-glow"></div>
        <div class="hero-deco-ring"></div>
        <div class="hero-deco-box1"></div>
        <div class="hero-deco-box2"></div>
        <svg data-anim="gear" width="78" height="78" viewBox="0 0 100 100" fill="none" class="hero-gear">
          <g fill="#FF5200">
            <rect x="43" y="3" width="14" height="22" rx="3"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(45 50 50)"/>
            <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(90 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(135 50 50)"/>
            <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(180 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(225 50 50)"/>
            <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(270 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(315 50 50)"/>
            <circle cx="50" cy="50" r="30"/>
          </g>
          <circle cx="50" cy="50" r="13" fill="#191513"/>
        </svg>
        <div class="hero-browser">
          <div class="hero-browser-bar">
            <span class="b-dot b-dot--orange"></span>
            <span class="b-dot b-dot--gray"></span>
            <span class="b-dot b-dot--gray"></span>
            <span class="b-url"></span>
          </div>
          <div class="hero-browser-body">
            <div class="hero-banner">
              <div class="hero-banner-ring"></div>
              <div class="hero-banner-line1"></div>
              <div class="hero-banner-line2"></div>
              <div class="hero-banner-btn"></div>
            </div>
            <div class="hero-stats">
              <div class="hero-stat">
                <div class="hero-stat-num hero-stat-num--orange">200+</div>
                <div class="hero-stat-bar hero-stat-bar--w80"></div>
              </div>
              <div class="hero-stat">
                <div class="hero-stat-num hero-stat-num--dark">24/7</div>
                <div class="hero-stat-bar hero-stat-bar--w70"></div>
              </div>
              <div class="hero-stat">
                <div class="hero-stat-num hero-stat-num--dark">98%</div>
                <div class="hero-stat-bar hero-stat-bar--w75"></div>
              </div>
            </div>
            <div class="hero-chart">
              <div class="c-bar c-bar-1"></div>
              <div class="c-bar c-bar-2"></div>
              <div class="c-bar c-bar-3"></div>
              <div class="c-bar c-bar-4"></div>
              <div class="c-bar c-bar-5"></div>
              <div class="c-bar c-bar-6"></div>
            </div>
          </div>
        </div>
        <div class="spd-badge">
          <div class="spd-ring">
            <div class="spd-inner">99</div>
          </div>
          <div>
            <div class="spd-text">Скорость</div>
            <div class="spd-sub">PageSpeed</div>
          </div>
        </div>
        <div class="seo-badge">
          <span class="seo-badge-check">✓</span>
          <span class="seo-badge-text">SEO в подарок</span>
        </div>
      </div>
    </div>

    {{-- Шаги процесса --}}
    <div id="process" class="process">
      <div class="process-head">
        <div class="process-label">Как мы работаем</div>
        <span class="process-hint">Понятный процесс от договора до запуска</span>
      </div>
      <div class="process-grid">
        @foreach($home['hero_steps'] ?? [] as $step)
        <div class="step-card">
          <div class="step-n">{{ $step['n'] ?? '' }}</div>
          <h3 class="step-title">{{ $step['title'] ?? '' }}</h3>
          <p class="step-desc">{{ $step['desc'] ?? '' }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- О СТУДИИ --}}
<section id="services" class="s-about">
  <div class="about-deco-1"></div>
  <div class="about-deco-2"></div>
  <div class="pg-inner">
    <div class="sec-label">О студии</div>
    <div class="about-grid">
      <div class="about-left">
        <h2 class="about-h2">
          {!! $home['about_h2'] ?? 'Не шаблоны, а <span class="text-gradient">инструменты</span> для бизнеса' !!}
        </h2>
        <div class="about-gear-row">
          <svg width="58" height="58" viewBox="0 0 100 100" fill="none" class="about-gear">
            <g fill="#FF5200"><rect x="43" y="3" width="14" height="22" rx="3"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(45 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(90 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(135 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(180 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(225 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(270 50 50)"/><rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(315 50 50)"/><circle cx="50" cy="50" r="30"/></g>
            <circle cx="50" cy="50" r="13" fill="#F2EDE6"/>
          </svg>
          <span class="about-founded">{{ $home['about_founded'] ?? 'Онлайн-студия Spb-Webmaster · Санкт-Петербург, с 2009 года' }}</span>
        </div>
        <div class="about-photo-wrap">
          <div class="about-photo-glow"></div>
          <div class="about-photo-ring"></div>
          <div class="about-photo-box1"></div>
          <div class="about-photo-box2"></div>
          <img src="{{ $aboutPhotoUrl }}" alt="Специалист студии Spb-Webmaster за работой" class="about-photo">
          <div class="about-years-badge">
            <span class="about-years-num">{{ $home['about_years'] ?? 25 }}</span>
            <span class="about-years-text">{{ $home['about_years_text'] ?? 'лет создаём сайты в Санкт-Петербурге' }}</span>
          </div>
        </div>
      </div>
      <div class="about-right">
     {!!   $home['about_p'] !!}
    <div class="seo-tags">
          @foreach($home['about_seo_tags'] ?? [] as $item)
          <span class="seo-tag">
            <span class="seo-tag-dot"></span>{{ $item['tag'] ?? '' }}
          </span>
          @endforeach
        </div>
        <div class="about-quote">
          <p>{{ $home['about_quote'] ?? 'Наша цель — создавать не просто красивые сайты, а эффективные инструменты для развития бизнеса, привлечения новых клиентов и укрепления присутствия компании в интернете.' }}</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ТЕХНОЛОГИИ --}}
<section class="s-tech">
  <div class="tech-deco-1"></div>
  <div class="tech-deco-2"></div>
  <div class="pg-inner">
    <div class="sec-label">Технологии</div>
    <h2 class="tech-h2">
      {!! $home['tech_h2'] ?? 'Создаём сайты на <span class="text-gradient">Laravel</span>' !!}
    </h2>
    <p class="tech-desc">{{ $home['tech_desc'] ?? 'Laravel — современный фреймворк для сайтов и веб-приложений на PHP. Это готовый «конструктор» для разработчика: вместо того чтобы делать всё с нуля, мы собираем проект из проверенных модулей — быстрее, надёжнее и удобнее для развития.' }}</p>
    <div class="tech-grid">
      {{-- Laravel-карточка --}}
      <div class="tech-card">
        <div class="tech-card-deco1"></div>
        <div class="tech-card-deco2"></div>
        <img src="{{ $laravelImageUrl }}" alt="Laravel" class="tech-logo">
        <h3 class="tech-card-h3">{{ $home['tech_laravel_title'] ?? 'Готовый конструктор, а не стройка с нуля' }}</h3>
        <p class="tech-card-p">{{ $home['tech_laravel_desc'] ?? 'Представьте дом из готовых стен, крыши и инженерных систем вместо самодельных кирпичей. Laravel даёт такие «детали» — мы собираем из них именно то, что нужно вашему бизнесу.' }}</p>
        <div class="tech-benefits">
          @foreach($home['tech_benefits'] ?? [] as $benefit)
          <span class="tech-benefit">
            <span class="tech-benefit-dot"></span>{{ $benefit['text'] ?? '' }}
          </span>
          @endforeach
        </div>
      </div>
      {{-- Сетка карточек возможностей --}}
      <div class="tech-features">
        @foreach($home['tech_features'] ?? [] as $i => $feature)
        <div class="spb-feature-card">
          <div class="feat-icon">
            {!! $featureIcons[$i] ?? $featureIcons[0] !!}
          </div>
          <h4 class="feat-h4">{{ $feature['title'] ?? '' }}</h4>
          <p class="feat-p">{{ $feature['desc'] ?? '' }}</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- ГАРАНТИИ --}}
<section id="guarantees" class="s-guarantees">
  <div class="g-deco-1"></div>
  <div class="g-deco-2"></div>
  <div class="g-deco-3"></div>
  <div class="pg-inner">
    <div class="g-header">
      <div>
        <div class="sec-label sec-label--white">Гарантии и качество</div>
        <h2 class="g-h2">{!!  $home['guarantees_h2'] ?? 'Вы защищены на каждом этапе' !!}</h2>
      </div>
      <p class="g-desc">{{ $home['guarantees_desc'] ?? 'Работаем по договору и отвечаем за результат. Сайт остаётся вашим, исходники передаём вам.' }}</p>
    </div>
    <div class="g-grid">
      @foreach($home['guarantees_items'] ?? [] as $gItem)
      <div class="g-card">
        <span class="g-card-tag">{{ $gItem['tag'] ?? '' }}</span>
        <h3 class="g-card-h3">{{ $gItem['title'] ?? '' }}</h3>
        <p class="g-card-p">{{ $gItem['desc'] ?? '' }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ВХОДИТ В СТОИМОСТЬ --}}
<section class="s-included">
  <div class="included-inner">
    <div class="included-left">
      <div class="sec-label">Без доплат</div>
      <h2 class="included-h2">{!!   $home['included_h2'] ?? 'Входит в стоимость любого сайта' !!}</h2>
      <p class="included-desc">{{ $home['included_desc'] ?? 'Каждый проект получает базовую внутреннюю оптимизацию и адаптив. Вам не придётся доплачивать за то, что должно работать по умолчанию.' }}</p>
      <a href="#cta" class="included-btn">Обсудить проект</a>
    </div>
    <div class="included-list">
      @foreach($home['included_items'] ?? [] as $inc)
      <div class="inc-item">
        <span class="inc-check">✓</span>
        <span class="inc-text">{{ $inc['text'] ?? '' }}</span>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- CTA ФОРМА --}}
<section id="cta" class="s-cta">
  <div class="cta-deco-1"></div>
  <div class="cta-deco-2"></div>
  <div class="pg-inner">
    <div class="cta-card">
      <div class="cta-img-col">
        <img src="{{ $contactPhotoUrl }}" alt="Консультант студии Spb-Webmaster" class="cta-img">
        <div class="cta-overlay1"></div>
        <div class="cta-overlay2"></div>
        <div class="cta-img-text">
          <div class="cta-reply-badge">
            <span class="cta-reply-dot"></span>Среднее время ответа — 1 час
          </div>
          <h2 class="cta-h2">Расскажите о проекте</h2>
          <p class="cta-p">Оставьте заявку — свяжемся в течение рабочего дня, бесплатно оценим объём и предложим решение.</p>
          <a href="tel:+{{ phone($settings['phone'] ?? '') }}" class="cta-phone">
            <span class="cta-phone-icon">
              <svg width="17" height="17" viewBox="0 0 24 24" fill="none"><path d="M6.6 10.8c1.4 2.8 3.8 5.1 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.2.2 2.4.6 3.6.1.4 0 .7-.2 1l-2.3 2.2z" fill="#fff"/></svg>
            </span>{{ format_phone(phone($settings['phone'] ?? '')) }}
          </a>
        </div>
      </div>
      <div class="cta-form-col">
        <x-form.callback-form
            variant="home"
            form-id="spb-contact-form"
            wrapper-id="spb-form-wrapper"
            response-id="spb-success-wrapper"
            reset-id="spb-form-reset"
            title="Бесплатный расчёт проекта"
            response-title="Заявка отправлена"
            response-text="Спасибо! Мы свяжемся с вами в течение рабочего дня."
        />
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  var header = document.getElementById('site-header');
  if (header) {
    var onHeaderScroll = function () {
      header.style.boxShadow = window.scrollY > 8 ? '0 6px 24px rgba(25,21,19,0.09)' : 'none';
    };
    window.addEventListener('scroll', onHeaderScroll, { passive: true });
    onHeaderScroll();
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

  if (reduce) return;

  var gear = document.querySelector('[data-anim="gear"]');
  if (gear) gear.style.animation = 'spbSpin 22s linear infinite';

  var sections = Array.from(document.querySelectorAll('section'));
  var hero = sections[0];
  if (hero) {
    hero.style.opacity = '0';
    hero.style.transform = 'translateY(14px)';
    hero.style.transition = 'opacity .8s ease, transform .8s ease';
    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        hero.style.opacity = '1';
        hero.style.transform = 'none';
      });
    });
  }
  var rest = sections.slice(1);
  rest.forEach(function (s) {
    s.style.opacity = '0';
    s.style.transform = 'translateY(30px)';
    s.style.transition = 'opacity .7s ease, transform .7s ease';
  });
  var reveal = function (s) { s.dataset._shown = '1'; s.style.opacity = '1'; s.style.transform = 'none'; };
  var checkSections = function () {
    var vh = window.innerHeight || document.documentElement.clientHeight;
    var remaining = false;
    rest.forEach(function (s) {
      if (s.dataset._shown) return;
      var r = s.getBoundingClientRect();
      if (r.top < vh * 0.9 && r.bottom > 0) reveal(s);
      else remaining = true;
    });
    if (!remaining) {
      window.removeEventListener('scroll', onRevealScroll, true);
      window.removeEventListener('resize', checkSections);
    }
  };
  var onRevealScroll = function () { checkSections(); };
  window.addEventListener('scroll', onRevealScroll, true);
  window.addEventListener('resize', checkSections);
  checkSections();
  setTimeout(function () { rest.forEach(reveal); }, 4500);
});
</script>
@endpush
