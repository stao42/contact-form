<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FashionablyLate</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Noto+Sans+JP:wght@300;400;500;700&family=Inika:wght@400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
      <div class="header__nav">
        @if(request()->routeIs('register'))
          <a href="{{ route('login') }}" class="header__nav-link">login</a>
        @elseif(request()->routeIs('login'))
          <a href="{{ route('register') }}" class="header__nav-link">register</a>
        @endif
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
