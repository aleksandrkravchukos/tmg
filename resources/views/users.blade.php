@extends('layout.home')
@section('title', 'Home. CRUD test task')
@section('content')

    <div class="row">
        <div class="col-xs-6 col-sm-4 col-md-3">
            <a href="/">Home</a>
            <a href="/users">Users</a>
        </div>
        <div class="col-xs-6 col-sm-4 col-md-3">
1
        </div>

        <div class="col-xs-6 col-sm-4 col-md-3">
            <i class="fa fa-quote-left"></i>
            The silence <a href="/users">is</a> <span class="fa">golden</span>
            <i class="fa fa-quote-right"></i>
        </div>
    </div>

@endsection

