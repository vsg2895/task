@extends('layouts.app')

@section('content')

    {{--    @dd();--}}
    <div class="container">
        <div class="flash-message">
            @foreach(['danger','warning','success','info'] as $msg)
                @if(Session::has('alert-'.$msg))

                    <p class="alert alert-{{$msg}}">{{ Session::get('alert-'.$msg) }}<a href="#" class="close"
                                                                                        data-dismiss="alert"
                                                                                        aria-label="close">&times</a>
                    </p>

                @endif

            @endforeach


        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">ActiveUsers</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('blocked_user') }}">BlockedUsers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('deleted_user') }}">DeletedUsers</a>
                    </li>


                </ul>
            </div>
        </nav>
        <h2>Comments</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Topic</th>
                <th>Author</th>
                <th>Publishing - Blocking</th>


            </tr>
            </thead>
            <tbody>
            @foreach($comments as $t)
{{--                @dump($t)--}}
                <tr>
                    <td><a href="{{ route('see_more',$t->id) }}" class="see_more">{{ $t->title }}</a></td>

                    <td> @if(strlen($t->content)<15){{$t->content}} @else{{Illuminate\Support\Str::limit($t->content, 14,'...') }}@endif</td>

                    <td>{{$t->comment_topic->name}}</td>
                    <td @if($t->comment_user->deleted_at != null) style="color: red" @endif>{{$t->comment_user->name}}</td>
                    <td>
{{--                        @dd($t->status)--}}
                        <div  @if ($t->status != 1)  class="buttonflex" @else class="buttonflex2" @endif>
                            @if($t->status == 0)
                                <form action="{{ route('publish_comment',$t->id) }}" method="post">
                                    @csrf

                                    <button type="submit" class="btn btn-success"> Publish</button>
                                </form>
                                <form action="{{ route('block_comment',$t->id) }}" method="post">
                                    @csrf

                                    <button type="submit" class="ml-2 btn btn-danger"> Block</button>
                                </form>
                            @else

                                <form action="{{ route('block_comment',$t->id) }}"  method="post">
                                    @csrf

                                    <button type="submit" class="btn btn-danger"> Block</button>
                                </form>

                            @endif
                        </div>


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


