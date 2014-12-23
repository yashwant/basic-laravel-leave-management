@extends('layouts.default')
@section('body')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2>Apply for leave here</h2>
        {{ Form::open(array('route' => array('leave.store'), 'method' => 'post')) }}
        @foreach ($errors->all() as $message)
        {{$message}}
        @endforeach
        <div class="form-group">
            {{Form::label('start','Start Date')}}
            {{Form::text('start', null,array('class' => 'form-control'))}}
        </div>
        <div class="form-group">
            {{Form::label('end','End Date')}}
            {{Form::text('end', null,array('class' => 'form-control'))}}
        </div>
        {{Form::submit('Apply', array('class' => 'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>
@stop