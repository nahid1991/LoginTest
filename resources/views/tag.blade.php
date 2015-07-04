@extends('others')


@section('something')

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
            <div class="custom1">

                <h1 style="font-weight: 900">Tags list.</h1>
                <p>
                    Available Tags.
                </p>

                {!! Form::open() !!}
                    @foreach($tags as $tag)
                        <div class="form-group">
                            <ul>
                                <li><p style="font-weight: 900">{{ $tag->name }}  <a href="{{ URL::route('delete', $tag->tag_id) }}">(X)</a></p></li>
                            </ul>
                        </div>
                    @endforeach


                {!! Form::close() !!}


            </div>

            <div class="custom2">
                {!! Form::model($tag = new \App\Tag, ['url' => 'tags']) !!}
                <div class="form-group">
                    <h1 style="font-weight: 900">Course adding system.</h1>
                    {!! Form::label('name', 'Tag name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!!  Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}

                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

            </div>


        </div>
    </div>

@stop