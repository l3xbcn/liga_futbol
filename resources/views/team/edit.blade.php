@extends('layouts.common')
@section('title', 'Equipo - Editar')
@section('content')
@foreach(['team.registro', 'team.form'] as $view)
    @include($view)
@endforeach
@endsection