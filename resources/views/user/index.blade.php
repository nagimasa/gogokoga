
@include('layouts.user')

<main class="">
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

    <div class="bg-white mb-5">
        <div class="px-2 py-4 border-gray-300 border-b border-t">
            <h2>カテゴリ別</h2>
        </div>
    <div>
</main>

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