@extends('layouts.common')
@section('title', 'Jugadores | Índice')
@section('content')
<?php if (!empty($mensaje)) { ?>
    <div class="mensaje" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
        <div>
            <p><strong>Se ha actualizado la base de datos: </strong><?=$mensaje?></p>
        </div>
    </div>
<?php } ?>            

    <table id="indice">
        <thead>
        <tr>
            <th class="w-1/12 ">ID</th>
            <th class="w-3/12">Nombre</th>
            <th class="w-3/12">Posición</th>
            <th class="w-3/12">Equipo</th>
            <th class="w-2/12">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($players as $player)
            <tr>
                <td>{{ $player->id }}</td>
                <td>{{ $player->name }}</td>
                <td>{{ $player->position }}</td>
                <td>{{ $player->team->name }}</td>
                <td>
                    <a href="{{ route('player.show', $player->id) }}" class="bg-blue-500 ">
                        <i class="fas fa-eye"></i>
                    </a>
                    @can('edit')
                    <a href="{{ route('player.edit', $player->id) }}" class="bg-yellow-500">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="inline-block" method="POST" action="{{ route('player.destroy',$player->id) }}">
                        @csrf  
                        @method("delete")
                        <a class="bg-red-500" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-trash"></i>
                        </a>                        
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="w-1/12 ">ID</th>
                <th class="w-3/12">Nombre</th>
                <th class="w-3/12">Posición</th>
                <th class="w-3/12">Equipo</th>
                <th class="w-2/12">Acciones</th>
            </tr>
        </tfoot>        
    </table>
    <script>
    </script>    

    {{ $players->links() }}
@endsection
