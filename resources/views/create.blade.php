@extends('layout')

@section('content')
<div class="card_upper">
    <div class="card-header">
        Create CSV
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('form.store') }}">
            <div class="form-group">
                @csrf
                <label for="name">Number of records:</label>
                <input type="number" class="form-control" name="records" />
            </div>
            <button type="submit" class="btn btn-primary">CREATE</button>
            <button type="reset" wire:click="cancel" class="btn btn-danger">CANCEL</button>
        </form>
        @if(Session::has('errors'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
    </div>
</div>
@endsection