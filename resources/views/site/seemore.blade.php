@extends('layouts.app')

@section('content')


    <div class="container">

        <div class="row">

            <div class="col-sm-8 col-md-8 col-lg-8">


                <div id="carouselExampleControls" class="mt-3 carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($seemore->array_image() as $key=>$i)
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

                    <h4 class="title_h"> {{$seemore->title}} </h4>

                </div>
                <div class="topic">
                    <h6>Topic - {{ $seemore->comment_topic->name }}</h6>

                </div>

                <div class="content">

                    {{--                    <p>{{ $a->content }}</p>--}}
                    <p>{{$seemore->content}} </p>
                </div>


            </div>

        </div>

    </div>

@endsection
