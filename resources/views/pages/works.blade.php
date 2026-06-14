@extends('layouts.layout')
<x-seo.meta
    title="{{ $w['metatitle'] ?? 'Наши работы — SPB-WEBMASTER' }}"
    description="{{ $w['description'] ?? 'Сайты и веб-сервисы, разработанные студией SPB-WEBMASTER: турагентства, страхование, госсектор, судебная экспертиза, билетные системы.' }}"
    keywords="{{ $w['keywords'] ?? 'портфолио веб-студии, разработка сайтов примеры, наши работы, веб-проекты' }}"
/>


@section('content')

{{-- HERO --}}
<section class="s-w-hero">
  <div class="w-hero-deco-1"></div>
  <div class="w-hero-deco-2"></div>
  <div class="pg-inner">
    <nav class="g-breadcrumb" aria-label="Breadcrumb">
      @foreach (Breadcrumbs::generate('works') as $crumb)
        @if (!$loop->last)<a href="{{ $crumb->url }}">{{ $crumb->title }}</a> &nbsp;/&nbsp;
        @else{{ $crumb->title }}@endif
      @endforeach
    </nav>
    <h1 class="w-hero-h1">Наши <span class="text-gradient">работы</span></h1>
    <p class="w-hero-subtitle">{{ $w['hero_subtitle'] ?? 'Сайты и веб-сервисы, которые мы спроектировали и разработали для бизнеса из разных отраслей — от турагентств и страхования до государственных реестров и билетных систем.' }}</p>
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

{{-- ПРОЕКТЫ --}}
<section class="s-w-projects">
  <div class="w-projects-deco"></div>
  <div class="pg-inner">

    {{-- фильтр --}}
    <div class="w-chips" id="w-chips">
      @foreach($cats as $cat)
        <button
          class="w-chip{{ $cat === 'Все' ? ' w-chip--active' : '' }}"
          data-cat="{{ $cat }}"
          type="button"
        >{{ $cat }}</button>
      @endforeach
    </div>

    {{-- карточки --}}
    <div class="w-cards" id="w-cards">
      @foreach($projects as $project)
      <div class="w-card" data-cat="{{ $project['cat'] }}">
        {{-- browser cover --}}
        <div class="w-card-browser">
          <div class="w-card-bar">
            <span class="w-dot w-dot--orange"></span>
            <span class="w-dot w-dot--gray"></span>
            <span class="w-dot w-dot--gray"></span>
            <span class="w-url-bar"></span>
          </div>
          <div class="w-card-cover">
            <x-picture.responsive
              :sizes="['480x250', '768x400', '1200x630']"
              :src="$project['cover_path']"
              :alt="$project['title']"
              class="w-cover-img"
              dir="works"
              method="scale"
              :data-project="$project['id']"
            />
          </div>
        </div>
        {{-- body --}}
        <div class="w-card-body">
          <span class="w-card-tag">{{ $project['category'] }}</span>
          <h3 class="w-card-h3">{{ $project['title'] }}</h3>
          <p class="w-card-p">{{ $project['desc'] }}</p>
          <div class="w-tech-list">
            @foreach($project['tech'] as $tech)
              <span class="w-tech-tag">{{ $tech['value'] }}</span>
            @endforeach
          </div>
          {{-- thumbnails --}}
          <div class="w-thumbs">
            @foreach($project['images'] as $i => $img)
            <button
              class="w-thumb{{ $i === 0 ? ' w-thumb--active' : '' }}"
              type="button"
              data-project="{{ $project['id'] }}"
              data-src="{{ $img['url'] }}"
            >
              <img src="{{ $img['url'] }}" alt="" loading="lazy">
            </button>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>

    {{-- CTA --}}
    <div class="w-cta">
      <div class="w-cta-deco"></div>
      <div>
        <h2 class="w-cta-h2">{{ $w['cta_h2'] ?? 'Хотите такой же проект?' }}</h2>
        <p class="w-cta-p">{{ $w['cta_p'] ?? 'Расскажите о задаче — бесплатно оценим объём и предложим решение под ваш бюджет.' }}</p>
      </div>
      <a href="{{ route('home') }}#cta" class="w-cta-btn">Обсудить проект</a>
    </div>

  </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  /* header shadow */
  var header = document.getElementById('site-header');
  if (header) {
    var onScroll = function () {
      header.style.boxShadow = window.scrollY > 8 ? '0 6px 24px rgba(25,21,19,0.09)' : 'none';
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* burger */
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

  /* section fade-in */
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

  /* count-up */
  Array.from(document.querySelectorAll('[data-count]')).forEach(function (el) {
    var raw = el.textContent.trim();
    var m = raw.match(/^(\D*)([\d\s]+)(\D*)$/);
    if (!m) return;
    var pre = m[1], mid = m[2], post = m[3];
    var trail = mid.match(/\s+$/);
    if (trail) { post = trail[0] + post; mid = mid.replace(/\s+$/, ''); }
    var target = parseInt(mid.replace(/\s/g, ''), 10);
    if (!isFinite(target)) return;
    var grouped = /\s/.test(mid);
    var fmt = function (n) { return grouped ? n.toLocaleString('ru-RU') : String(n); };
    var dur = 1100, start = performance.now();
    var tick = function (now) {
      var t = Math.min(1, (now - start) / dur);
      var eased = 1 - Math.pow(1 - t, 3);
      el.textContent = pre + fmt(Math.round(target * eased)) + post;
      if (t < 1) requestAnimationFrame(tick);
    };
    el.textContent = pre + '0' + post;
    requestAnimationFrame(tick);
  });

  /* filter chips */
  var chips = Array.from(document.querySelectorAll('#w-chips .w-chip'));
  var cards = Array.from(document.querySelectorAll('#w-cards .w-card'));
  chips.forEach(function (chip) {
    chip.addEventListener('click', function () {
      chips.forEach(function (c) { c.classList.remove('w-chip--active'); });
      chip.classList.add('w-chip--active');
      var cat = chip.dataset.cat;
      cards.forEach(function (card) {
        card.style.display = (cat === 'Все' || card.dataset.cat === cat) ? '' : 'none';
      });
    });
  });

  /* thumbnail switcher */
  document.querySelectorAll('.w-thumb').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var projectId = btn.dataset.project;
      var src = btn.dataset.src;
      var cover = document.querySelector('.w-cover-img[data-project="' + projectId + '"]');
      if (cover) cover.src = src;
      document.querySelectorAll('.w-thumb[data-project="' + projectId + '"]').forEach(function (t) {
        t.classList.remove('w-thumb--active');
      });
      btn.classList.add('w-thumb--active');
    });
  });
});
</script>
@endpush
