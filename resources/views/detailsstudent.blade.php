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
            @if(!$user->real_name)
                <li><a href="{{ url('/change') }}">Add Name</a></li>
            @endif
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

    @foreach($question as $questions)
        <div class="container">
            <div class="row">
                @if($questions->real_name)
                    <div class="col-md-12-details">
                        <a href="#"><h1>{{ $questions->real_name }}</h1></a>
                        <a href="#"><p>{{ $questions->username }}</p></a>
                        <p><small>{{ $questions->dept_name }} Department</small></p>
                    </div>
                @endif
                @if(!$questions->real_name)
                        <div class="col-md-12-details">
                            <a href="#"><h1>{{ $questions->username }}</h1></a>
                            <p><small>{{ $questions->dept_name }} Department</small></p>
                        </div>
                @endif
                <div class="propic-question">
                    @if($questions->propic)
                        {{--<img src ="{{ $user->propic }}" width="80px" height="80px" alt="supposed to be a pic here!!!"/>--}}
                        <div>
                            <img src ="{{ asset($questions->propic) }}" width="150px" height="150px" alt="supposed to be a pic here!!!"/>
                        </div>
                    @endif
                    @if(!$questions->propic)
                        <div>
                            <img src ="/images/propic.jpg" alt="supposed to be a pic here!!!"/>
                        </div>
                    @endif
                </div>

                <div class="col-md-12-questions">
                    <h1 style="color:#3c763d">Asked question:</h1>
                    <h2><b>{{ $questions->title }}</b></h2>
                    <p>{{ $questions->body }}</p>
                    <p>
                        {{ $questions->likes }}
                        <a href="{{   action('QuestionController@liked', [$questions->que_id])  }}"><img src="../images/notliked.png" height="40px" width="30px"></a>
                        {{ $questions->dislikes }}
                        <a href="{{   action('QuestionController@disliked', [$questions->que_id])  }}"><img src="../images/downvote.png" height="18px" width="13px"></a>
                    </p>
                </div>




            </div>
        </div>
    @endforeach

    @foreach($comment as $comments)
        <div class="col-md-8 col-md-offset-2-comment form-content">
            {{--<a href="#"><img src="{{ asset($comments->propic) }}" width="30px" height="30px"/></a>--}}
            <h3><a href="#"><img src="{{ asset($comments->propic) }}" width="30px" height="30px"/></a>
                <a href="#">{{ $comments->real_name }}</a></h3>
            <h4>{{ $comments->comment_body }}</h4>
            <p>
                {{ $comments->comment_likes }}
                <a href="{{   action('CommentController@liked', [$comments->comment_id])  }}"><img src="../images/notliked.png" height="40px" width="30px"></a>
                {{ $comments->comment_dislikes }}
                <a href="{{   action('CommentController@disliked', [$comments->comment_id])  }}"><img src="../images/downvote.png" height="18px" width="13px"></a>
            </p>
        </div>
    @endforeach

    @foreach($question as $questions)
        <div class="col-md-8 col-md-offset-2-comment form-content">

            <h1 class="heading">Try to answer</h1>
            <h3><a href="#">{{ $user->real_name }}</a></h3>
            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{!!$error!!}</p>
            @endforeach
            {!! Form::open(['url' => '/comment', 'class'=>'form form-horizontal']) !!}
            <input type="hidden" name="q_id" value="{{ $questions->que_id }}"/>
            {{--<input type="hidden" name="username" value="{{ $user->username }}"/>--}}
            <div class="form-group">
                {!! Form::label('comment_body', 'Your answer:') !!}
                {!! Form::textarea('comment_body', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!!  Form::submit('Answer', ['class'=>'btn btn-primary form-control']) !!}
            </div>
            {!!Form::close()!!}
        </div>
    @endforeach



@stop

@section('footer')
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