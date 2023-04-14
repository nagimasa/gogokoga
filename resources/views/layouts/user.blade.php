<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        {{-- ハンバーガーメニュー --}}
        <link href="{{ asset('css/menu.css') }}" rel="stylesheet">

        {{-- デザインcss --}}
        {{-- <link href="{{ asset('css/reset.css') }}" rel="stylesheet"> --}}
        <link href="{{ asset('css//header.css') }}" rel="stylesheet">


        {{-- fontawesome --}}
        <script src="https://kit.fontawesome.com/2f02d6fd6d.js" crossorigin="anonymous"></script>


        
    </head>
    <body class="bg-gray-200">
    <header class="header mb-2">
        <div class="header__inner">
            <div class="flex">
                <div class="home">
                    <h1><i class="fa-solid fa-house fa-2xl"></i></h1>
                </div>
                <p class="lead-text">福岡県古賀市で活躍するお店や企業を応援する地域密着型の情報サイト</p>
                <button id="js-humberger" type="button" class="humberger" aria-controls="navigation" aria-expanded="false">
                    <span class="humberger__line"></span>
                    <span class="humberger__text"></span>
                </button>
            </div>
          <div class="header__nav-area js-nav-area" id="navigation">
            <nav id="js-global-navigation" class="global-navigation">
              <ul class="global-navigation__list">
                <li>
                  <a href="#" class="global-navigation__link">
                    メニュー
                  </a>
                </li>
                   <li>
                  <button type="button" class="global-navigation__link -accordion js-sp-accordion-trigger" aria-expanded = 'false' aria-controls="accordion1">
                    親メニュー
                  </button>
                     <div id="accordion1" class="accordion js-accordion">
                       <ul class="accordion__list">
                         <li>
                           <a href="#" class="accordion__link">
                             子メニュー
                           </a>
                         </li>
                          <li>
                           <a href="#" class="accordion__link">
                             子メニュー
                           </a>
                         </li>
                          <li>
                           <a href="#" class="accordion__link">
                             子メニュー
                           </a>
                         </li>
                       </ul>
                     </div>
                </li>
                <li>
                  <a href="#" class="global-navigation__link">
                    メニュー
                  </a>
                </li> 
              </ul>
              <div id="js-focus-trap" tabindex="0"></div>
            </nav>
          </div>
        </div>
      </header>
