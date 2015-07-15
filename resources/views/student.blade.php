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
        <a class="navbar-brand" href="/student">NSU Forum</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/student') }}">Home</a></li>
            <li><a href="{{ url('/change') }}">Add Name</a></li>
            <li><a href="{{ url('/reset') }}">Change Password</a></li>
        </ul>
        @foreach($tagStudent as $tagStudents)
            <ul class="nav navbar-nav">
                <li><a href="{{   action('QuestionController@show', [$tagStudents->tag_id])  }}">{{ $tagStudents->name }}</a></li>
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
            @if($user->real_name)
                <div class="col-md-12">
                    <h1>{{ $user->real_name }}</h1>
                    <p>{{ $user->username }}</p>
                    <p>{{ $user->dept_name }} Department</p>
                    <p>Welcome to the Dashboard.</p>
                </div>
            @endif
            @if(!$user->real_name)
                <div class="col-md-12">
                    <h1>{{ $user->username }}</h1>
                    <p>{{ $user->dept_name }} Department</p>
                    <p>Welcome to the Dashboard.</p>
                </div>
            @endif
            <div class="propic">
                @if($user->propic)
                {{--<img src ="{{ $user->propic }}" width="80px" height="80px" alt="supposed to be a pic here!!!"/>--}}
                <div>
                    <img src ="{{ asset($user->propic) }}" width="150px" height="150px" alt="supposed to be a pic here!!!"/>
                    {!! Form::open(['url'=>'/propic', 'files'=>true]) !!}
                        {!! Form::file('image',['class'=>'btn btn-default']) !!}
                        {!!  Form::submit('Set this pic', ['class'=>'btn btn-primary form-control']) !!}
                    {!! Form::close() !!}
                </div>
                @endif
                @if(!$user->propic)
                <div>
                    <img src ="/images/propic.jpg" alt="supposed to be a pic here!!!"/>
                    {!! Form::open(['url'=>'/propic', 'files'=>true]) !!}
                        {!! Form::file('image',['class'=>'btn btn-default']) !!}
                        {!!  Form::submit('Set this pic', ['class'=>'btn btn-primary form-control']) !!}
                    {!! Form::close() !!}
                </div>
                @endif
            </div>
        </div>
    </div>

@stop


@section('question')
    <div class="col-md-8 col-md-offset-2-question form-content">

        <h1 class="heading">Ask a Question</h1>
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!! Form::open(['url' => '/question', 'class'=>'form form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('title', 'Question Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Detail:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('tag_id', 'Tags:') !!}
            {!! Form::select('tag_id', $intag, null, ['id'=>'intag', 'class'=>'form-control', 'mutliple']) !!}
        </div>
        <div class="form-group">
            {!!  Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}
        </div>
        {!!Form::close()!!}
    </div>

    <div class="col-md-8 col-md-offset-2-question-left form-content">
        {!! Form::open(['url' => '/tags/student', 'class'=>'form form-horizontal']) !!}
        <div class="form-group">
            <h1 style="font-weight: 900">Choose Tags</h1>
            {!! Form::label('tag_id', 'Tags:') !!}
            {!! Form::select('tag_id', $all, null, ['id'=>'all', 'class'=>'form-control', 'mutliple']) !!}
        </div>
        <div class="form-group">
            {!!  Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}
        </div>
        {!!Form::close()!!}

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
    </div>

    <div class="col-md-8 col-md-offset-2-question-left form-content">
        <h1 style="font-weight: 900">Available Tags</h1>

        <div>
            {!! Form::open() !!}
            @foreach($tagStudent as $tagStudents)
                <div class="form-group">
                    <ul>
                        <li><p style="font-weight: 900">{{ $tagStudents->name }}
                                <a href="{{ URL::route('tagDelete', $tagStudents->tag_id) }}">(X)</a></p></li>
                    </ul>
                </div>
            @endforeach
            {!! Form::close() !!}
        </div>



    </div>

@stop

@section('footer')d
    <div class="container">
        <div class="row" style="text-align: center; font-size: 15px; padding-top: 20px">
            <p>Powered by Sayed Mahmudul Alam,
                Nahid Islam, A.S.M. Nesar Uddin.</p>
            <marquee><p style="color:red">Mostly Nahid Islam though</p></marquee>
            <br/>
            <br/>
            <br/>
            <br/>
        </div>
    </div>
@stop

<script>

    $('#tags').select2({
        placeholder: 'Choose a tag'
//            tags: true,
//            ajax: {
//                dataType: 'json',
//                url: 'api/tags',
//                delay: 250,
//                data: function(params){
//                    return
//                    {
//                        q: params.term
//                    }
//                },
//
//                processResults: function(data)
//                {
//                    return{ results:data }
//                }
//            }
    });

</script>