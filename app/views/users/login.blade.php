
@extends('layouts.default')
@section('body')
{{ Form::open(array('url' => 'login', 'method' => 'post')) }}
@foreach ($errors->all() as $message)
{{$message}}
@endforeach
{{Form::label('email','Email')}}
{{Form::text('email', null,array('class' => 'form-control'))}}
{{Form::label('password','Password')}}
{{Form::password('password',array('class' => 'form-control'))}}
{{Form::submit('Login', array('class' => 'btn btn-primary'))}}
{{ Form::close() }}


@stop