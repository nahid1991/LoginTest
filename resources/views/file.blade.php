@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    @if(Session::has('success'))
                        <div class="alert-success">
                            <h2>{{ Session::get('success') }}</h2>
                        </div>
                    @endif

                    <div class="panel-body">
                        {!! Form::open(['url'=>'registration/now', 'files'=>true])!!}
                        <div class="form-group">
                            {!!Form::file('name',['class'=>'btn btn-default'])!!}
                        </div>
                        <div class="form-group">
                            {!!  Form::submit('Submit', ['class'=>'btn btn-primary form-control']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @if(Session::has('error'))
                        <p class="errors">{!! Session::get('error') !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

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