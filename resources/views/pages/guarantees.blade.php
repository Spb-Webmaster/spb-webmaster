@extends('layouts.layout')
<x-seo.meta
    title="{{ $g['metatitle'] ?? 'Гарантии — SPB-WEBMASTER' }}"
    description="{{ $g['description'] ?? '12 месяцев гарантии на каждый проект. Бесплатно исправляем технические ошибки по нашей вине. Все условия фиксируем в договоре.' }}"
    keywords="{{ $g['keywords'] ?? 'гарантия на сайт, гарантийное обслуживание сайта, разработка с гарантией' }}"
/>


@section('content')

{{-- HERO --}}
<section class="s-g-hero">
  <svg data-anim="gear" width="78" height="78" viewBox="0 0 100 100" fill="none" class="g-hero-gear">
    <g fill="rgba(255,82,0,0.85)">
      <rect x="43" y="3" width="14" height="22" rx="3"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(45 50 50)"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(90 50 50)"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(135 50 50)"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(180 50 50)"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(225 50 50)"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(270 50 50)"/>
      <rect x="43" y="3" width="14" height="22" rx="3" transform="rotate(315 50 50)"/>
      <circle cx="50" cy="50" r="30"/>
    </g>
    <circle cx="50" cy="50" r="13" fill="#191513"/>
  </svg>
  <div class="g-hero-deco-box"></div>
  <div class="pg-inner">
    <nav class="g-breadcrumb" aria-label="Breadcrumb">
      @foreach (Breadcrumbs::generate('guarantees') as $crumb)
        @if (!$loop->last)<a href="{{ $crumb->url }}">{{ $crumb->title }}</a> &nbsp;/&nbsp;
        @else{{ $crumb->title }}@endif
      @endforeach
    </nav>
    <div class="g-badge">
      <span class="g-badge-dot"></span>Гарантия качества
    </div>
    <h1 class="g-h1"><span class="text-gradient">{{ $g['hero_h1_gradient'] ?? '12 месяцев' }}</span> {{ $g['hero_h1_tail'] ?? 'гарантии на каждый проект' }}</h1>
    <p class="g-subtitle">{{ $g['hero_subtitle'] ?? 'Мы отвечаем за работу всего, что создаём. Если в течение года любая функция перестанет работать по нашей вине — исправим бесплатно. Без споров и скрытых условий.' }}</p>
    <div class="g-stats">
      @foreach($stats as $stat)
      <div>
        <div class="g-stat-val-row">
          <span class="g-stat-value" data-count>{{ $stat['value'] }}</span>
        </div>
        <div class="g-stat-label">{{ $stat['label'] }}</div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- КАК ЭТО РАБОТАЕТ --}}
<section class="s-g-how">
  <div class="pg-inner">
    <div class="sec-label">Как это работает</div>
    <h2 class="g-how-h2">Простая и честная схема</h2>
    <div class="g-how-grid">
      @foreach($steps as $step)
      <div class="g-step-card">
        <div class="g-step-icon">{!! $step['icon'] !!}</div>
        <div class="g-step-n">Шаг {{ $step['n'] }}</div>
        <h3 class="g-step-title">{{ $step['title'] }}</h3>
        <p class="g-step-desc">{{ $step['desc'] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ЧТО ПОКРЫВАЕТ / КОГДА НЕ ДЕЙСТВУЕТ --}}
<section class="s-g-cov">
  <div class="pg-inner">
    <div class="g-cov-grid">
      <div class="g-col-light">
        <div class="g-col-head">
          <span class="g-col-icon-ok">✓</span>
          <h3 class="g-col-title-light">Что покрывает гарантия</h3>
        </div>
        <div class="g-col-list">
          @foreach($covered as $item)
          <div class="g-col-item">
            <span class="g-item-check">✓</span>
            <span class="g-item-text-light">{{ $item }}</span>
          </div>
          @endforeach
        </div>
      </div>
      <div class="g-col-dark">
        <div class="g-col-head">
          <span class="g-col-icon-no">!</span>
          <h3 class="g-col-title-dark">Когда гарантия не действует</h3>
        </div>
        <div class="g-col-list">
          @foreach($voided as $item)
          <div class="g-col-item">
            <span class="g-item-x">✕</span>
            <span class="g-item-text-dark">{{ $item }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ВАЖНОЕ УСЛОВИЕ --}}
<section class="s-g-cond">
  <div class="g-cond-deco1"></div>
  <div class="g-cond-deco2"></div>
  <div class="pg-inner">
    <div class="g-cond-grid">
      <div>
        <div class="g-cond-label">Важное условие</div>
        <h2 class="g-cond-h2">{{ $g['cond_h2'] ?? 'Работайте через админ-панель' }}</h2>
        <p class="g-cond-p">{{ $g['cond_p'] ?? 'Гарантия действует, пока сайт остаётся в том виде, в котором мы его сдали. Управляйте контентом через удобную админ-панель — все нужные правки доступны там, без вмешательства в код.' }}</p>
      </div>
      <div class="g-cond-cards">
        <div class="g-cond-card">
          <span class="g-cond-icon-ok">{!! $iconPanel !!}</span>
          <div>
            <div class="g-cond-card-title">Можно</div>
            <p class="g-cond-card-p">Менять тексты, фото, товары, страницы и настройки через админ-панель сайта.</p>
          </div>
        </div>
        <div class="g-cond-card">
          <span class="g-cond-icon-no">{!! $iconCode !!}</span>
          <div>
            <div class="g-cond-card-title">Снимает гарантию</div>
            <p class="g-cond-card-p">Изменение исходного кода сайта, правки файлов на сервере или вмешательство сторонних разработчиков.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="s-g-cta">
  <div class="g-cta-deco"></div>
  <div class="pg-inner">
    <div class="g-cta-inner">
      <div>
        <h2 class="g-cta-h2">{{ $g['cta_h2'] ?? 'Хотите проект с гарантией?' }}</h2>
        <p class="g-cta-p">{{ $g['cta_p'] ?? 'Все условия гарантии и сроки фиксируем в договоре до старта работ.' }}</p>
      </div>
      <a href="{{ route('home') }}#cta" class="g-cta-btn">Обсудить проект</a>
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
    var gear = document.querySelector('[data-anim="gear"]');
    if (gear) gear.style.animation = 'spbSpin 22s linear infinite';

    var sections = Array.from(document.querySelectorAll('section'));
    sections.forEach(function (s, i) {
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

  /* count-up animation for stats */
  Array.from(document.querySelectorAll('[data-count]')).forEach(function (el) {
    var raw = el.textContent.trim();
    var m = raw.match(/^(\D*)([\d]+)(\D*)$/);
    if (!m) return;
    var pre = m[1], target = parseInt(m[2], 10), post = m[3];
    if (!isFinite(target)) return;
    var dur = 1100, start = performance.now();
    var tick = function (now) {
      var t = Math.min(1, (now - start) / dur);
      var eased = 1 - Math.pow(1 - t, 3);
      el.textContent = pre + Math.round(target * eased) + post;
      if (t < 1) requestAnimationFrame(tick);
    };
    el.textContent = pre + '0' + post;
    requestAnimationFrame(tick);
  });
});
</script>
@endpush
