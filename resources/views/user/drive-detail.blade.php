
@include('layouts.user')

<main class="detail sm:max-w-3xl sm:m-auto">

        <a class="blog-btn" href="{{ route('user.blog.index', $detail->id )}}">
            <img src="{{ asset('storage/images/blog-btn.svg')}}">
        </a>

        <a class="call-btn" href="tel:{{ $detail->tel }}">
            <img src="{{ asset('storage/images/call-btn.svg')}}">
        </a>

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h1 class="text-2xl">{{ $detail->service_name}}<span class="subtitle text-xs font-bold">{{ $detail->area->area_name}}</span></h1>
            @if($detail->phototop)
                <img src="{{ secure_asset($detail->phototop->top_image_name) }}">
            @endif

            @if($detail->tags)
                @foreach($detail->tags as $tag)
                    <span>{{ $tag->tag_name }}</span>
                @endforeach
            @endif
        </section>
    </article>

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h2 class="text-2xl sub-title service-title">サービス内容</h2>
            @if($detail->first_fee)
            <dl class="">
                <div class="py-2 border-b flex justify-between">
                    <dt class="w-60">初乗り料金：</dt>
                    <dd class="">{{ $detail->first_fee}}円</dd>
                </div>
            </dl>
            @endif
            @if($detail->add_fee)
            <dl class="">
                <div class="py-2 border-b flex justify-between">
                    <dt class="w-60">追加料金：</dt>
                    <dd class="">{{ $detail->add_fee}}円</dd>
                </div>
            </dl>
            @endif
            @if($detail->stay_fee)
            <dl class="">
                <div class="py-2 border-b flex justify-between">
                    <dt class="w-60">待機料金：</dt>
                    <dd class="">{{ $detail->stay_fee}}円</dd>
                </div>
            </dl>
            @endif
            @if($detail->cancel_fee)
            <dl class="">
                <div class="py-2 border-b flex justify-between">
                    <dt class="w-60">キャンセル料金：</dt>
                    <dd class="">{{ $detail->cancel_fee}}</dd>
                </div>
            </dl>
            @endif
        </section>
    </article>


    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h2 class="text-2xl sub-title time-title">営業時間</h2>
            <dl>
                <div class="py-2 border-b flex justify-between">
                <dt>日曜日：</dt>
                @if( $detail->sunday )
                <dd>{{ $detail->sunday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>月曜日：</dt>
                @if( $detail->monday )
                <dd>{{ $detail->monday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>火曜日：</dt>
                @if( $detail->tuesday )
                <dd>{{ $detail->tuesday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>水曜日：</dt>
                @if( $detail->wednesday )
                <dd>{{ $detail->wednesday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>木曜日：</dt>
                @if( $detail->thursday )
                <dd>{{ $detail->thursday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>金曜日：</dt>
                @if( $detail->friday )
                <dd>{{ $detail->friday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>土曜日：</dt>
                @if( $detail->saturday )
                <dd>{{ $detail->saturday}}</dd>
                @else
                登録されていません
                @endif
            </div>

            <div class="py-2 border-b flex justify-between">
                <dt>祝日：</dt>
                @if( $detail->regular_holiday )
                <dd>{{ $detail->regular_holiday}}</dd>
                @else
                登録されていません
                @endif
            </div>
            </dl>
        </section>
    </article>

    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h2 class="text-2xl sub-title coupon-title">クーポン</h2>
            @if($detail->coupon)
            <h3>{{ $detail->coupon->coupon_title}}</h3>
            <p>{!! $detail->coupon->coupon_text !!}</p>
                @if($detail->coupon->coupon_image)
                    <img src="{{ asset($detail->coupon->coupon_image )}}">
                @endif
            @endif
        </section>
    </article>

    <article class="bg-white mb-5 px-2 py-4">
        <section class="border-gray-300">
            <h2 class="text-2xl sub-title comment-title">店舗からのコメント</h2>
            @if($detail->comments)
                <p>{{ $detail->comments->comment}}</p>
            @endif

            {{-- @if($detail->photogall)
                @foreach($detail->photogall as $photogall)
                    <img src="{{ secure_asset($photogall->image_name) }}">
                @endforeach
            @endif --}}
        </section>
    </article>


    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h2 class="text-2xl sub-title info-title">基本情報</h2>
            <dl>
            @if( $detail->service_name )
                <div class="py-2 border-b flex justify-between">
                    <dt>店舗名</dt>
                    <dd>{{ $detail->service_name}}</dd>
                </div>
            @endif

            @if( $detail->tel )
                <div class="py-2 border-b flex justify-between">
                    <dt>電話番号</dt>
                    <dd>{{ $detail->tel}}</dd>
                </div>
            @endif

            @if( $detail->email )
                <div class="py-2 border-b flex justify-between">
                    <dt>メール</dt>
                    <dd>{{ $detail->email }}</dd>
                </div>
            @endif


            @if( $detail->area )
                <div class="py-2 border-b flex justify-between">
                    <dt>地域</dt>
                    <dd>{{ $detail->area->area_name}}</dd>
                </div>
            @endif


            @if( $detail->address )
                <div class="py-2 border-b flex justify-between">
                    <dt>住所</dt>
                    <dd>{{ $detail->address}}</dd>
                </div>
            @endif


            @if( $detail->genre )
                <div class="py-2 border-b flex justify-between">
                    <dt>カテゴリ</dt>
                    <dd>{{ $detail->genre->genre_name }}</dd>
                </div>
            @endif


            @if( $detail->parking )
                <div class="py-2 border-b flex justify-between">
                    <dt>駐車場</dt>
                    <dd>{{ $detail->parking}}</dd>
                </div>
            @endif


            @if( $detail->url )
                <div class="py-2 border-b flex justify-between">
                    <dt>url</dt>
                    <dd>{{ $detail->url}}</dd>
                </div>
            @endif


            @if( $detail->googlemap )
                <div class="py-2 border-b flex justify-between">
                    <dt>マップ</dt>
                    <dd>{{ $detail->googlemap}}</dd>
                </div>
            @endif


            @if( $detail->payments )
                <div class="py-2 border-b flex justify-between">
                    <dt>支払い方法</dt>
                    <dd>
                        @foreach($detail->payments as $payment)
                        {{ $payment->payment_name }}
                        @endforeach
                    </dd>
                </div>
            @endif
        </dl>
        </section>
    </article>


    @if($detail->photogalls)
    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300">
            <h2 class="text-2xl sub-title photo-title">ギャラリー</h2>
        <div id="my_gal11">

            <!-- ここから写真部分。↓ -->
            
            <div class="base">
                
                <!-- ここからデータ。↓ -->
                    <!-- title属性にオンマウスで表示されるツールチップ。不要ならば削除。 -->
                        @foreach($detail->photogall as $photogall)
                            <img src="{{ secure_asset($photogall->image_name) }}">
                        @endforeach
                <!-- ここまでデータ。↑ -->
                
            </div>    
            <!-- ここまで写真部分。↑ -->
                
            <!-- ここからギャラリー。↓ -->
            <div class="gallery">
                <!-- ここからサムネイル。↓ -->
                <!-- 写真部分の写真と同じ順番に。写真部分の写真を流用してもよい。 -->
                @if($detail->photogall)
                    @foreach($detail->photogall as $photogall)
                        <img class="pb-1" src="{{ secure_asset($photogall->image_name) }}">
                    @endforeach
                @endif
                <!-- ここまでサムネイル。↑ -->
            </div>
            <!-- ここまでギャラリー。↑ -->
        </section>
    </article>
    @endif


{{-- 
    <article class="bg-white mb-5 blog">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl blog-title">ブログの更新</h2>
            <div class="blog-area p-4">
                <div class="blog-item pb-2 border-b border-gray-200">
                    ここに店舗カテゴリを判定してバッチを表示させる仕組みを入れる
                    <h3 class="text-base mb-2">店舗名</h3>
                    <p class="text-xs mb-2">更新日時</p>
                    <p class="text-xs font-bold mb-2">スタッフコメント</p>
                </div>
            </div>
        </section>
    </article> --}}


    {{-- <article class="bg-white mb-5 transpotation">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl blog-title">交通</h2>
            <div class="flex flex-wrap justify-around">
                <a href="">
                    <div class="category-item mb-1">
                    </div>
                </a>
                <a href="">
                    <div class="category-item mb-1">
                    </div>
                </a>
            </div>
        </section>
    </article> --}}


@if($detail->reqruit)
    <article class="bg-white mb-5 px-2 py-10">
        <section class="border-gray-300" id="{{ $detail->reqruit->service_id}}">
            <h2 class="text-2xl sub-title reqruit-title">求人</h2>
            @if($detail->reqruit)
            <h3>{{ $detail->reqruit->reqruit_title}}</h3>
            <p>{!! $detail->reqruit->reqruit_text!!}</p>
            <dl>
                @if($detail->reqruit->work_type)
                <div class="py-2 border-b flex justify-between">
                    <dt>雇用形態</dt>
                    <dd>{{ $detail->reqruit->work_type }}</dd>
                </div>
                @endif
                @if($detail->reqruit->work_in_day)
                <div class="py-2 border-b flex justify-between">
                    <dt>１日の勤務時間</dt>
                    <dd>{{ $detail->reqruit->work_in_day }}</dd>
                </div>
                @endif
                @if($detail->reqruit->work_in_week)
                <div class="py-2 border-b flex justify-between">
                    <dt>１週間の勤務日数</dt>
                    <dd>{{ $detail->reqruit->work_in_week }}</dd>
                </div>
                @endif
                @if($detail->reqruit->fee)
                <div class="py-2 border-b flex justify-between">
                    <dt>賃金（{{$detail->reqruit->fee_type}}）</dt>
                    <dd>{{ $detail->reqruit->fee_type }}</dd>
                </div>
                @endif
                @if($detail->reqruit->address)
                <div class="py-2 border-b flex justify-between">
                    <dt>勤務地</dt>
                    <dd>{{ $detail->reqruit->address }}</dd>
                </div>
                @endif
                @if($detail->reqruit->maneger_name_kana)
                <div class="py-2 border-b flex justify-between">
                    <dt>担当者名</dt>
                    <dd>{{ $detail->reqruit->maneger_name_kana }}</dd>
                </div>
                @endif
                @if($detail->reqruit->maneger_tel)
                <div class="py-2 border-b flex justify-between">
                    <dt>担当者電話番号</dt>
                    <dd><a href="tel:{{ $detail->reqruit->maneger_tel }}">{{ $detail->reqruit->maneger_tel }}</a></dd>
                </div>
                @endif
                @if($detail->reqruit->maneger_email)
                <div class="py-2 border-b flex justify-between">
                    <dt>担当者メールアドレス</dt>
                    <dd>{{ $detail->reqruit->maneger_email }}</a></dd>
                </div>
                @endif
            </dl>
            @endif
        </section>
    </article>
@endif



    {{-- <article class="bg-white mb-5 typograph">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl typograph-title">51音順</h2>
            <div class="search-item p-4 border-b border-gray-200 flex justify-around">
                <div class="flex justify-around w-full">
                    <a href="">
                        あ
                    </a>
                    <a href="">
                        い
                    </a>
                    <a href="">
                        う
                    </a>
                    <a href="">
                        え
                    </a>
                    <a href="">
                        お
                    </a>
                </div>
                <div class="flex justify-around w-full border-l">
                    <a href="">
                        あ
                    </a>
                    <a href="">
                        い
                    </a>
                    <a href="">
                        う
                    </a>
                    <a href="">
                        え
                    </a>
                    <a href="">
                        お
                    </a>
                </div>
            </div>
        </section>
    </article> --}}

</main>

@include('layouts.user-footer')
