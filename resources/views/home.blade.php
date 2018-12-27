@extends('layouts.dashboard', ['title' => 'Dashboard'])

@section('content')
    @component('tile')
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    You are logged in!
    @endcomponent
@endsection
