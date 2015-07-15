<!-- -->
@extends('others')

@section('something')
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/dash-board">NSU Forum</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/dash-board') }}">Home</a></li>
            <li><a href="{{ url('/reset') }}">Change Password</a></li>
            <li><a href="{{ url('/change') }}">Add Name</a></li>

        </ul>
        @foreach($tags as $tag)
            <ul class="nav navbar-nav">
                <li><a href="{{   action('QuestionController@show', [$tag->tag_id])  }}">{{ $tag->name }}</a></li>
            </ul>
        @endforeach

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ url('/auth/login') }}">Login</a></li>
                <li><a href="{{ url('/auth/register') }}">Register</a></li>

            @else
                {{--<ul class="nav navbar-new">--}}
                {{--<li><a href="{{ url('/auth/logout') }}>Logout</a></li>--}}
                {{--</ul>--}}
                <li>
                    <a href='/auth/logout'>Logout</a>
                </li>

                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu" role="menu">--}}
                {{--<li><a href="{{ url('/auth/logout') }}">Logout</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
            @endif
        </ul>
    </div>

@stop




@section('main')

    <div class="container">
        <div class="row">
            <h1 style="margin-left: 25px">Questions So far</h1>
            @foreach($question as $questions)
                <div class="col-md-12-forquestions">
                    <ul>
                        <li>
                            <h3><a href="{{   action('QuestionController@details', [$questions->que_id])  }}">{{ $questions->title }}</a></h3>
                            @if($questions->real_name)
                                <p><small>by <a href="#">{{ $questions->real_name }}</a></small></p>
                            @endif
                            @if(!$questions->real_name)
                                <p><small>by <a href="#">{{ $questions->username }}</a></small></p>
                            @endif
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </div>

@stop



@section('footer')
    <div class="container">
        <div class="row" style="text-align: center; font-size: 15px; padding-top: 20px">
            <p>Powered by Sayed Mahmudul Alam,
                Nahid Islam, A.S.M. Nesar Uddin</p>
            <marquee><p style="color:red">Mostly Nahid Islam though</p></marquee>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
@stop