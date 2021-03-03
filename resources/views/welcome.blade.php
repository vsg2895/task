@extends('layouts.app')

@section('content')


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
        <button type="button" class="btn btn-danger" data-toggle="modal" id="add_comment" data-target="#form">
            See Modal with Form
        </button>
        <div class="row">

            <div class="mt-3 col-sm-12 col-md-12 col-lg-12 all_blocks">

                @foreach($users_comments as $a)

                    {{--            @dd($a->array_image());--}}
                    <div class="col-sm-3 col-md-3 col-lg-3 comment_block">
                        <div id="carouselExampleControls" class="mt-3 carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($a->array_image() as $key=>$i)
                                    <div class="carousel-item @if($key == 0) active @endif">
                                        <img class="d-block w-100" src="{{ asset('/storage/image/'.$i) }}"
                                             alt="First slide">
                                    </div>
                                @endforeach

                            </div>
                            {{--                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"--}}
                            {{--                               data-slide="prev">--}}
                            {{--                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
                            {{--                                <span class="sr-only">Previous</span>--}}
                            {{--                            </a>--}}
                            {{--                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"--}}
                            {{--                               data-slide="next">--}}
                            {{--                                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
                            {{--                                <span class="sr-only">Next</span>--}}
                            {{--                            </a>--}}
                        </div>
                        <div class="title">

                            <h4 class="title_h"> {{ $a->title }}</h4>

                        </div>
                        <div class="topic">
                            <h6>Topic - {{ $a->comment_topic->name }}</h6>

                        </div>

                        <div class="content">

                            <p>{{ $a->content }}</p>
                        </div>
                    </div>



                @endforeach


            </div>

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
