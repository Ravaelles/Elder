@extends('app')

@section('htmlheader_title')
Server error
@endsection

@section('contentheader_title')
An error occured
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<?php
if (!empty($message)) {
    $errorCode = "Error";
} else {
    $errorCode = "Error";
    $message = "Error";
}
?>

<div class="error-page" style="width: 800px; background-color: rgba(230, 230, 230, 0.5); padding: 10px;">
    <h2 class="headline text-red">{{ $errorCode or "500" }}</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
        <p>
            <b>We're sorry, an error has occured</b><br />

            Please <a href='{{ \URL::previous() }}'>go back</a>
            <br />
            or <a href='{{ url('/home') }}'>return to home page</a>
        </p>
    </div>

    @if (env("APP_DEBUG"))
    <div class="box box-default" style="width: 800px; margin-top: 20px; font-size: 10px; word-break: break-all;">
        <h4>{{ $message or "---" }}</h4>
        {!! str_ireplace("\n", "\n<br />", $e) !!}
    </div>
    @endif
</div><!-- /.error-page -->
@endsection