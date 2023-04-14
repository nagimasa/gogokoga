
@include('layouts.user')


<p>てsつおt</p>

<div class="flex wrap w-8/12 justify-end">
    <div class="roudend pr-2">
        {{ Form::open(['route' => ['user.search'], 'method' => 'get']) }}
        {{ Form::text('keyword', old('keyword'), ['placeholder' => 'キーワードを入力','class' => 'form-control roudend']) }}
    </div>
    <div class="roudend pr-2">
        <select id="genre_id" name="genre_id">
            <option value="">ジャンルを選択</option>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
            @endforeach
        </select>
    </div>
    <div class=" roudend pr-2">
        <select id="area_id" name="area_id">
            <option value="">地域を選択</option>
            @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
    {{ Form::submit('検索', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
    {{ Form::close() }}
    </div>
</div>


</body>
{{-- <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body> --}}

<script src="{{ asset('js/menu.js') }}"></script>
</html>