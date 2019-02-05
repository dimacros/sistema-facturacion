@extends('layouts.dashboard', ['type' => 'staff'])

@section('title', 'Escritorio de Trabajador')

@section('content')
    @component('tile')
        Esto es el panel del trabajador
    @endcomponent
@endsection