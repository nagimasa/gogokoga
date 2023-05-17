<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            コメントの設定
        </h1>
    </x-slot>

    <div class="py-12 px-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="text-gray-900">
                    <div class="flex justify-between bg-blue-600 ">
                        <h2 class="text-xl text-white p-6">{{ $service->service_name }}のコメント設定</h2>



                        @if(!empty($comment->comment))
                        <div class=" pr-6 pt-6">
                            {{ Form::open(['route' => ['owner.comments.destroy', $service->id], 'method' => 'post']) }}
                            @csrf
                            @method('delete')
                            {{ Form::submit('削除', ['class' => 'btn text-white bg-red-600 border-0 py-2 px-6 mb-2 hover:bg-red-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                        @endif
                    </div>
                    <div class="p-6">

                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach

                            {{ Form::open(['route' => ['owner.comments.update', $service->id], 'method' => 'post']) }}
                        @csrf
                        @method('PATCH')
                        <div class="py-6">
                            {{Form::hidden('service_id', $service->id )}}
                            {{ Form::label('comment','コメント内容',['class' => 'font-bold'])}}<br>
                            @if(!empty($comment->comment))
                            {{ Form::textarea('comment', $comment->comment, ['class' => 'w-full md:w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'コメント内容'])}}
                            @else
                            {{ Form::textarea('comment','', ['class' => 'w-full md:w-1/2 rounded form-control ', 'id' => 'lastName', 'placeholder' => 'コメント内容'])}}
                            @endif
                        </div>
                        <hr>
                        <div class="py-6 flex justify-between">
                            <a href="{{ route('owner.comments.show', [$service->id]) }}" class="text-white bg-gray-500 border-0 py-2 px-6 mb-2 hover:bg-gray-600 rounded">
                                戻る
                            </a>
                            {{ Form::submit('送信', ['class' => 'btn text-white bg-blue-600 border-0 py-2 px-6 mb-2 hover:bg-blue-700 rounded']) }}
                            {{ Form::close() }}
                        </div>
                     </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
