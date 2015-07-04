<!-- -->
@extends('others')

@section('something')

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/') }}">Home</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ url('/auth/register') }}">Register</a></li>
            @else
                {{--<ul class="nav navbar-new">--}}
                {{--<li><a href="{{ url('/auth/logout') }}>Logout</a></li>--}}
                {{--</ul>--}}
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
        <h3 class="heading">Login</h3>
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'auth/login','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}
        <div class="form-group">
            {!! Form::label('email','Email:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::text('email',Input::old('email'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('password','Password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('password',['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group" style="text-align: center">
            <input name="user_type" type="radio" value="1">Admin</input>
            <input name="user_type" type="radio" value="2">Student</input>
            <input name="user_type" type="radio" value="3">Faculty</input>
        </div>
        <div class="text-center">
            {!!Form::submit('Login',['class'=>'btn btn-default'])!!}
        </div>
        {!!Form::close()!!}
        {{--{!! HTML::link('/auth/register','Register',['class'=>'btn btn-link']) !!}--}}
    </div>

@stop

