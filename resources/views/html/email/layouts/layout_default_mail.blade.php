<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Письмо с сайта')</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f5;font-family:Arial,Helvetica,sans-serif;">
  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="background:#f4f4f5;padding:32px 0;">
    <tr>
      <td align="center">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="580" style="max-width:580px;width:100%;">

          {{-- Шапка --}}
          <tr>
            <td style="background:#191513;border-radius:12px 12px 0 0;padding:24px 32px;">
              <span style="font-family:Arial,Helvetica,sans-serif;font-size:18px;font-weight:700;color:#ffffff;letter-spacing:-0.3px;">
                {{ config('app.name') }}
              </span>
            </td>
          </tr>

          {{-- Тело --}}
          <tr>
            <td style="background:#ffffff;padding:32px;">

              <p style="margin:0 0 20px;font-family:Arial,Helvetica,sans-serif;font-size:20px;font-weight:700;color:#191513;">
                @yield('title', 'Новая заявка')
              </p>
              <p style="margin:0 0 28px;font-family:Arial,Helvetica,sans-serif;font-size:14px;color:#667085;line-height:1.6;">
                @yield('description')
              </p>

              @yield('content')

            </td>
          </tr>

          {{-- Подвал --}}
          <tr>
            <td style="background:#f4f4f5;border-radius:0 0 12px 12px;padding:20px 32px;text-align:center;">
              <span style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#98a2b3;">
                Письмо сформировано автоматически сайтом
                <a href="{{ config('app.url') }}" style="color:#FF5200;text-decoration:none;">{{ config('app.url') }}</a>
              </span>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
