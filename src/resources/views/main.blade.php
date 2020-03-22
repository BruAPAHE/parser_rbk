@extends('layouts.app')

@section('content')
    <div class="container">
        @isset($news)
            <ul class="list-group">
                @foreach($news as $key => $item)
                    <li style="width: 65%" class="list-group-item">{{$key+1}}. <a href="{{$item['link']}}"
                                                                                  class="button">{{$item['title']}}</a>
                        <p style="font-size:12px; padding-top: 10px">{{$item['description']}}</p>
                    </li>
                @endforeach
            </ul>
        @endisset
    </div>
@endsection
