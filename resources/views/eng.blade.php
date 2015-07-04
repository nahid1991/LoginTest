@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">ENG faculties</div>

                    <div class="panel-body">
                        Available Faculty members:
                    </div>
                    <div class="panel-body">
                        @foreach($faculty as $faculties)
                            <ul>
                                <li><p  style="font-weight: 900">{{ $faculties->username }}</p></li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection