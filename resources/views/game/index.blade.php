@extends('layouts.common')
@section('title', 'Equipos | Índice')
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
            <th class="w-1/12">Edición</th>
            <th class="w-1/12">Jornada</th>
            <th class="w-1/12">Resultado</th>
            <th class="w-2/12">Equipo local</th>
            <th class="w-2/12">Equipo visitante</th>
            <th class="w-1/12">Goles local</th>
            <th class="w-1/12">Goles visitante</th>
            <th class="w-2/12">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($games as $game)
            <tr>
                <td>{{ $game->id }}</td>
                <td>{{ $game->edition_id }}</td>
                <td>{{ $game->match_day }}</td>
                <td class="text-center font-black">
                    @if($game->goals_local == $game->goals_visitor)
                        <div class="bg-yellow-500">X</div>
                    @elseif($game->goals_local > $game->goals_visitor)
                    <div class="bg-blue-500">1</div>
                    @elseif($game->goals_local < $game->goals_visitor)
                        <div class="bg-red-500">2</div>
                    @endif
                </td>
                </td>
                <td>{{ $game->team_local->name }}</td>
                <td>{{ $game->team_visitor->name }}</td>
                <td>{{ $game->goals_local }}</td>
                <td>{{ $game->goals_visitor }}</td>

                <td>
                    <a href="{{ route('game.show',$game->id) }}" class="bg-blue-500 ">
                        <i class="fas fa-eye"></i>
                    </a>
                    @can('edit')
                    <a href="{{ route('game.edit',$game->id) }}" class="bg-yellow-500">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="inline-block" method="POST" action="{{ route('game.destroy',$game->id) }}">
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
                <th class="w-1/12">Edición</th>
                <th class="w-1/12">Jornada</th>
                <th class="w-1/12">Resultado</th>
                <th class="w-2/12">Equipo local</th>
                <th class="w-2/12">Equipo visitante</th>
                <th class="w-1/12">Goles local</th>
                <th class="w-1/12">Goles visitante</th>
                <th class="w-2/12">Acciones</th>
            </tr>
        </tfoot>        
    </table>
    <script>
    </script>    

    {{ $games->links() }}
@endsection
