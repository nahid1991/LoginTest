@extends('app')

@section('content')
    <div class="col-md-8 col-md-offset-2 form-content">

        <h3 class="heading">Password Reset</h3>
        @foreach($errors->all() as $error)
            <p class="alert alert-danger">{!!$error!!}</p>
        @endforeach
        {!!Form::open(['url'=>'/reset/pass','class'=>'form form-horizontal','style'=>'margin-top:50px'])!!}

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
            {!! Form::label('password','New Password:',['class'=>'col-sm-3 control-label']) !!}
            <div class="col-sm-8">
                {!! Form::password('passwordNew',['class'=>'form-control']) !!}
            </div>
        </div>


        <div class="text-center">
            {!!Form::submit('Reset Password',['class'=>'btn btn-default'])!!}
        </div>
        {!!Form::close()!!}
    </div>
@endsection
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