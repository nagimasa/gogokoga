
@include('layouts.user')

<main class="index sm:max-w-3xl sm:m-auto">
    <div class="bg-white mb-5">
        <div class=" px-2 py-4 border-gray-300 border-b border-t">
            <div class="roudend mb-2">
                {{ Form::open(['route' => ['user.search'], 'method' => 'get']) }}
                <div class="flex mb-2">
                    <div class="roudend pr-2 w-1/2">
                        <select id="genre_id" name="genre_id" class="w-full">
                            <option value="">ジャンルを選択</option>
                            @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" roudend w-1/2">
                        <select id="area_id" name="area_id" class="w-full">
                            <option value="">地域を選択</option>
                            @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{ Form::text('keyword', old('keyword'), ['placeholder' => 'キーワードを入力','class' => 'form-control roudend w-full']) }}
            </div>
            {{ Form::submit('検索', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 hover:bg-blue-700 rounded w-full']) }}
            {{ Form::close() }}
        </div>
    </div>


    <article class="bg-white mb-5">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl category-title">カテゴリ別</h2>
            <div class="flex flex-wrap justify-start m-auto">
                <a class="category-item pb-3" href="{{ route('user.category', ['category' => 'restaurant']) }}">
                
                        <img class="w-full" src="{{ asset('storage/images/restaurant-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'beauty']) }}">
                
                        <img class="w-full" src="{{ asset('storage/images/beauty-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'hotel']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/hotel-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'school']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/school-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'activity']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/activity-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'shop']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/shop-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'life']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/life-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'hospital']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/hospital-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'walfare']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/walfare-btn.jpg') }}">
                    
                </a>
                <a class="category-item m-auto pb-3" href="{{ route('user.category', ['category' => 'company']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/company-btn.jpg') }}">
                    
                </a>
                <a class="category-item pb-3" href="{{ route('user.category', ['category' => 'city']) }}">
                    
                        <img class="w-full" src="{{ asset('storage/images/city-btn.jpg') }}">
                    
                </a>
            </div>
        </section>
    </article>



    <article class="bg-white mb-5 blog">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl blog-title">ブログの更新</h2>
            <div class="blog-area p-4">
                @foreach($blogs as $blog)
                    <a href="{{ route('user.blog.show', [$blog->service->id ,$blog->id])}}">
                    <div class="blog-item pb-2 border-b border-gray-200">
                        <p class="service-name">{{ $blog->service->service_name}}</p>
                        <p class="blog-title text-xs">{{ $blog->blog_title}}</p>
                        <p class="created-at text-xs">{{ $blog->created_at->format('y/m/d')}}</p>
                    </div>
                    </a>
                @endforeach
            </div>
        </section>
    </article>


    <article class="bg-white mb-5 transpotation">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <h2 class="text-2xl blog-title">交通</h2>
            <div class="flex flex-nowrap justify-around">
                <a class="pr-1" href="{{ route('user.drive', ['category' => 'drive']) }}">
                    <img class="w-full" src="{{ asset('storage/images/drive-btn.jpg') }}">
                </a>
                <a href="{{ route('user.drive', ['category' => 'taxi']) }}">
                    <img class="w-full" src="{{ asset('storage/images/taxi-btn.jpg') }}">
                </a>
            </div>
        </section>
    </article>




    <article class="bg-white mb-5 reqruit">
        <section class="px-2 py-4 border-gray-300 border-b border-t">
            <div class="m-auto w-full">
                <h2 class="text-2xl reqruit-title">求人</h2>
                <a href="{{ route('user.reqruit') }}">
                    <div class="">
                        <img class="w-full" src="{{ asset('storage/images/reqruit-btn.jpg') }}">
                    </div>
                </a>
            </div>
        </section>
    </article>


</main>

@include('layouts.user-footer')
