@extends('layouts.common')
@section('title', 'Jugador - Editar')
@section('content')
@foreach(['jugador.registro', 'jugador.form'] as $view)
    @include($view)
@endforeach
@endsection