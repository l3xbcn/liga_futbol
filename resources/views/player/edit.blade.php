@extends('layouts.common')
@section('title', 'Jugador - Editar')
@section('content')
@foreach(['player.registro', 'player.form'] as $view)
    @include($view)
@endforeach
@endsection