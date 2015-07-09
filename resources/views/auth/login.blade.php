@extends('others')


@section('something')

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li style="font-size:900%; padding-top:90px"><a href="{{ url('/') }}">NSU Forum</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                {{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
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

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    </div>

@stop

@section('footer')
    <div class="container">
        <div class="row" style="text-align: center; font-size: 15px; padding-top: 20px">
            <p>Powered by Sayed Mahmudul Alam,
                Nahid Islam, A.S.M. Nesar Uddin</p>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
@stop