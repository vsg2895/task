@extends('layouts.app')

@section('content')

    <input type="hidden" id="is_auth" value="{{ $auth }}">
    <input type="hidden" id="login_route" value="{{ route('login') }}">
    <input type="hidden" id="filtr_route" value="{{ route('filtr') }}">
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
        @if(session('errors'))


            @foreach($errors as $e)

                <li>{{ $e }}</li>

            @endforeach

        @endif


        <div class="filtr_block">
            <button type="button" class="btn btn-danger" id="add_comment" data-toggle="modal" data-target="#form">
                Add Comment
            </button>
            @if(!Auth::check())
                <div class="form-group">
                    <label for="email1">Filtr Topics</label>
                    <select class="browser-default custom-select filtr_select" id="topic" name="topic">
                        <option value="0" selected>Select topic</option>
                        @foreach($topics as $t)
                            <option value="{{$t->id}}">{{ $t->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="email1">Filtr Time</label>
                    <select class="browser-default custom-select filtr_select" id="in_time" name="in_time">
                        <option value="0" selected>Select time</option>

                        <option value="1">Old - New</option>
                        <option value="2">New - Old</option>


                    </select>
                </div>
            @endif
        </div>

        <div class="row" id="comments_row">

            {{--            @include('site.filtr', ['user_comments' => $users_comments])--}}

            {{--            @dd(count($users_comments))--}}
            @if(count($users_comments) > 0 )
                <div class="mt-3 col-sm-12 col-md-12 col-lg-12 all_blocks">

                    @foreach($users_comments as $a)

                        {{--            @dd($a->array_image());--}}
                        <div class="ml-5 mt-2 col-sm-3 col-md-3 col-lg-3 comment_block">
                            <div id="carouselExampleControls" class="mt-3 carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($a->array_image() as $key=>$i)
                                        <div class="carousel-item @if($key == 0) active @endif">
                                            <img class="d-block w-100" src="{{ asset('/storage/image/'.$i) }}"
                                                 alt="First slide">
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                            <div class="title">

                                <h4 class="title_h"> @if(strlen($a->title)<18){{$a->title}} @else{{Illuminate\Support\Str::limit($a->title, 18,'...') }}@endif</h4>

                            </div>
                            <div class="topic">
                                <h6>Topic - {{ $a->comment_topic->name }}</h6>

                            </div>

                            <div class="content">

                                {{--                    <p>{{ $a->content }}</p>--}}
                                <p>@if(strlen($a->content)<40){{$a->content}} @else{{Illuminate\Support\Str::limit($a->content, 40,'...') }}@endif</p>
                            </div>
                            <div class="seemore_block">
                                <a href="{{ route('see_more',$a->id) }}" class="see_more">

                                    SeeMore

                                </a>
                            </div>

                        </div>



                    @endforeach


                </div>
            @else
                <div class="mt-3 col-sm-12 col-md-12 col-lg-12">

                    <h2>{{ Auth::user()->name }} - {{ Auth::user()->name }} dont have a Comments</h2>

                </div>

            @endif

        </div>


    </div>

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Create Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('add_comment') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email1">Topics</label>
                            <select class="browser-default custom-select" name="topic">
                                <option selected>Select topic</option>
                                @foreach($topics as $t)
                                    <option value="{{$t->id}}">{{ $t->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <input type="text" class="form-control" id="content" name="content">
                        </div>
                        <div class="form-group">
                            <label for="img">Images</label>
                            <input type="file" id="img" name="img[]" multiple>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
