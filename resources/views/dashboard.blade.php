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
            <li><a href="{{ url('/tags') }}">Create Tag</a></li>
        </ul>
        @foreach($tags as $tag)
            <ul class="nav navbar-nav">
                <li><a href="{{ url('/dash-board') }}">{{ $tag->name }}</a></li>
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
            <div class="col-md-12">
                <p>{{ $user->username }}</p>
                <p>Welcome to the Dashboard.</p>
            </div>
        </div>
    </div>

@stop