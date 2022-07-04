@extends('layout')

@section('content')

<style>
    body {
        text-align: center;
    }
</style>
<div class="container">
    <form method='post' action='/upload' enctype='multipart/form-data'>
        {{ csrf_field() }}
        <input type='file' name='file'>
        <input type='submit' name='submit' value='Import'>
    </form>
</div>