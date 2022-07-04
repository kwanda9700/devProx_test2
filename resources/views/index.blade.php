@extends('layout')

@section('content')

<style>
    body {
        text-align: center;
    }
</style>

<div class="button-container-div">
    <form method="get" action="{{ route('create') }}">
        <button type="submit" id="indexButton" class="btn btn-primary">Generate Records</button>
    </form>

</div>