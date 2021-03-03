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

        <h2>Comments</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Topic</th>
                <th>Author</th>
                <th>Publishing</th>
                <th>Blocking</th>


            </tr>
            </thead>
            <tbody>
            @foreach($comments as $t)
                <tr>
                    <td><a href="{{ route('see_more',$t->id) }}" class="see_more">{{ $t->title }}</a></td>
                    <td> @if(strlen($t->content)<15){{$t->content}} @else{{Illuminate\Support\Str::limit($t->content, 14,'...') }}@endif</td>

                    <td>{{$t->comment_topic->name}}</td>
                    <td>{{$t->comment_user->name}}</td>
                    <td>
                        <form action="{{ route('publish_comment',$t->id) }}" method="post">
                            @csrf

                            <button type="submit" class="btn btn-success"> Publish</button>
                        </form>

                    </td>
                    <td>
                        <form action="{{ route('block_comment',$t->id) }}" method="post">
                            @csrf
{{--                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>--}}

                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="mt-2 ml-2 form-group">
                                            <label for="email1">Select reason</label>
                                            <select class="browser-default custom-select" id="reason" name="reason">
                                                <option value="0" selected>Select reason</option>
                                                @foreach($reasons as $t)
                                                    <option value="{{$t->id}}">{{ $t->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success" id="modal_submit" name="submit">Block</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".bd-example-modal-sm"> Block</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
