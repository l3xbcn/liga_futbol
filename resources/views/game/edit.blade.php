@extends('layouts.common')
@section('title', 'Partido - Editar')
@section('content')
@foreach(['game.registro', 'game.form'] as $view)
    @include($view)
@endforeach
@endsection