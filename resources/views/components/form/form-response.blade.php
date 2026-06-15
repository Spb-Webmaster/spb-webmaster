@props([
    'variant' => 'modal',
    'id' => null,
    'title' => 'Спасибо',
    'text' => 'Мы получили вашу заявку, наш менеджер свяжется с вами в ближайшее время',
])

@if($variant === 'home')
    <div @if($id) id="{{ $id }}" @endif class="cta-success" data-callback-response>
        <div class="cta-success-icon">✓</div>
        <h3 class="cta-success-h3">{{ $title }}</h3>
        <p class="cta-success-p">{{ $text }}</p>
        <div class="cta-success-contacts">
            @if(!empty($settings['phone']))
                <a href="tel:+{{ phone($settings['phone']) }}" class="cta-success-contact">
                    {{ format_phone(phone($settings['phone'])) }}
                </a>
            @endif
            @if(!empty($settings['telegram']))
                <a href="{{ $settings['telegram'] }}" class="cta-success-contact" target="_blank" rel="noopener noreferrer">
                    Telegram
                </a>
            @endif
        </div>
    </div>
@elseif($variant === 'contacts')
    <div @if($id) id="{{ $id }}" @endif class="c-success" data-callback-response>
        <div class="c-success-icon">✓</div>
        <h2 class="c-success-h2">{{ $title }}</h2>
        <p class="c-success-p">{{ $text }}</p>
        <div class="c-success-contacts">
            @if(!empty($settings['phone']))
                <a href="tel:+{{ phone($settings['phone']) }}" class="c-success-contact">
                    {{ format_phone(phone($settings['phone'])) }}
                </a>
            @endif
            @if(!empty($settings['telegram']))
                <a href="{{ $settings['telegram'] }}" class="c-success-contact" target="_blank" rel="noopener noreferrer">
                    Telegram
                </a>
            @endif
        </div>
    </div>
@else
    <div @if($id) id="{{ $id }}" @endif class="form_form-response app_form_response" data-callback-response>
        <div class="af-message">
            <p class="form_response__title h1">{{ $title }}</p>
            <p class="form_response__img"><img alt="" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iNDAuMDAwNiIgY3k9IjM5Ljk5OTciIHI9IjM2LjY2NjciIHN0cm9rZT0iIzQzRDM4QiIgc3Ryb2tlLXdpZHRoPSIzIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPHBhdGggZD0iTTI2LjY2NiA0NS4yMzgxTDM4LjA5NDYgNTIuODU3MUw1My4zMzI3IDMwIiBzdHJva2U9IiM0M0QzOEIiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+Cjwvc3ZnPgo="></p>
            <p class="form_response__text">{{ $text }}</p>
            <div class="form_response__contacts">
                @if(!empty($settings['phone']))
                    <a href="tel:+{{ phone($settings['phone']) }}" class="form_response__contact">
                        {{ format_phone(phone($settings['phone'])) }}
                    </a>
                @endif
                @if(!empty($settings['telegram']))
                    <a href="{{ $settings['telegram'] }}" class="form_response__contact" target="_blank" rel="noopener noreferrer">
                        Telegram
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif
