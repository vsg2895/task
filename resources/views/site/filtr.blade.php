
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

