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
        <link href="{{ asset('css//style.css') }}" rel="stylesheet">


        {{-- fontawesome --}}
        <script src="https://kit.fontawesome.com/2f02d6fd6d.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="bg-gray-200">
    <header class="header mb-2">
        <div class="header__inner m-auto sm:max-w-3xl">
            <div class="flex">
                <div class="home">
                    <a href="{{ route('user.index') }}"><h1 class=" pt-4"><i class="fa-solid fa-house fa-2xl text-white"></i></h1></a>
                </div>
                <p class="text-white text-xs pt-4">福岡県古賀市で活躍するお店や企業を応援する地域密着型の情報サイト</p>
                <button id="js-humberger" type="button" class="humberger" aria-controls="navigation" aria-expanded="false">
                    <span class="humberger__line"></span>
                    <span class="humberger__text"></span>
                </button>
            </div>
          <div class="header__nav-area js-nav-area" id="navigation">
            <nav id="js-global-navigation" class="global-navigation">
              <ul class="global-navigation__list">
                <li class="list-none">
                  <a href="{{ route('user.index') }}" class="global-navigation__link text-base">
                    TOP
                  </a>
                </li>
                   <li class="list-none">
                  <button type="button" class="global-navigation__link -accordion js-sp-accordion-trigger text-base" aria-expanded = 'false' aria-controls="accordion1">
                    カテゴリ別
                  </button>
                     <div id="accordion1" class="accordion js-accordion">
                       <ul class="accordion__list">
                         <li class="list-none">
                           <a href="{{ route('user.category', ['category' => 'restaurant']) }}" class="accordion__link text-base">
                             飲食店
                           </a>
                         </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'beauty']) }}" class="accordion__link text-base">
                          美容
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'hotel']) }}" class="accordion__link text-base">
                          宿泊
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'school']) }}" class="accordion__link text-base">
                          習い事
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'activity']) }}" class="accordion__link text-base">
                          遊び
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'shop']) }}" class="accordion__link text-base">
                          ショップ
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'life']) }}" class="accordion__link text-base">
                          生活
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'hospital']) }}" class="accordion__link text-base">
                          医療
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'walfare']) }}" class="accordion__link text-base">
                          福祉
                          </a>
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'company']) }}" class="accordion__link text-base">
                          企業
                        </a>  
                        </li>
                        <li class="list-none">
                          <a href="{{ route('user.category', ['category' => 'city']) }}" class="accordion__link text-base">
                          古賀市施設
                          </a>
                        </li>
                       </ul>
                     </div>
                </li>
                <li class="list-none text-base">
               <button type="button" class="global-navigation__link -accordion js-sp-accordion-trigger" aria-expanded = 'false' aria-controls="accordion1">
                 交通
               </button>
                  <div id="accordion1" class="accordion js-accordion">
                    <ul class="accordion__list">
                      <li class="list-none">
                        <a href="{{ route('user.category', ['category' => 'drive']) }}" class="accordion__link text-base">
                          運転代行
                        </a>
                      </li>
                      <li class="list-none">
                        <a href="{{ route('user.category', ['category' => 'taxi']) }}" class="accordion__link text-base">
                          タクシー
                        </a>
                      </li>
                    </ul>
                  </div>
                <li class="list-none">
                  <a href="{{ route('user.category', ['category' => 'reqruit']) }}" class="global-navigation__link text-base">
                    求人
                  </a>
                </li> 
              </ul>
              <div id="js-focus-trap" tabindex="0"></div>
            </nav>
          </div>
        </div>
      </header>
