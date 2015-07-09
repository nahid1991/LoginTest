@extends('others')

@section('something')
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/student">NSU Forum</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/student') }}">Home</a></li>
            <li><a href="{{ url('/change') }}">Add Name</a></li>
            <li><a href="{{ url('/reset') }}">Change Password</a></li>
            <li></li>
        </ul>


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
    <div class="col-md-8 col-md-offset-2 form-content">

        <h1 class="heading">Change your name</h1>
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'/change/name','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}

        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
        {{--<div class="form-group">--}}
        {{--{!! Form::label('email','Email:',['class'=>'col-sm-3 control-label']) !!}--}}
        {{--<div class="col-sm-8">--}}
        {{--{!! Form::text('email',Input::old('email'),['class'=>'form-control']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
        {{--{!! Form::label('password','Password:',['class'=>'col-sm-3 control-label']) !!}--}}
        {{--<div class="col-sm-8">--}}
        {{--{!! Form::password('password',['class'=>'form-control']) !!}--}}
        {{--</div>--}}
        {{--</div>--}}

        <div class="form-group">
            <div class="form-group" style="padding-left: 30px; padding-right: 30px">
                {!! Form::label('name', 'Your Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
        </div>


        <div class="text-center">
            {!!  Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}
        </div>
        {!!Form::close()!!}
    </div>

@stop

@section('footer')
    <div class="container">
        <div class="row" style="text-align: center; font-size: 15px; padding-top: 20px">
            <p>Powered by Sayed Mahmudul Alam,
                Nahid Islam, A.S.M. Nesar Uddin.</p>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
@stop