@extends('layouts.common')
@section('title', 'Usuario - Editar')
@section('content')
@foreach(['user.registro', 'user.form'] as $view)
    @include($view)
@endforeach
@endsection