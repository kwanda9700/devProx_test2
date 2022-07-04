@extends('layout')

@section('content')

<style>
    body {
        text-align: center;
    }
</style>

<div class="button-container-div">
    <form method="get" action="{{ route('create') }}">
        <p>"CSV file is successfully imported."</p>
        <button type="submit" id="indexButton" class="btn btn-primary">Create new records</button>
    </form>

</div>