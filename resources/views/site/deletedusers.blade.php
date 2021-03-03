@extends('layouts.app')

@section('content')
{{--@dd('fjghfdgfdg')--}}
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
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">ActiveUsers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blocked_user') }}">BlockedUsers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blocked_comments') }}">BlockedComments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all_comments') }}">AllComments</a>
                    </li>

                </ul>
            </div>
        </nav>
        <h2>Comments</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>LastName</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>SignIn</th>
{{--                <th>Activating</th>--}}





            </tr>
            </thead>
            <tbody>
            @foreach($all_users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</td>

                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone  }}</td>
                    <td>{{ $user->user_role->name }}</td>
                    <td>{{ $user->created_at }}</td>

{{--                    <td>--}}
{{--                        <form action="{{ route('activate_user',$user->id) }}" method="post">--}}
{{--                            @csrf--}}

{{--                            <button type="submit" class="btn btn-danger">Activate</button>--}}
{{--                        </form>--}}

{{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>

@endsection
