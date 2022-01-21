<table>
    <thead>
        <tr>
        <th colspan=2>Ficha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID</td>
            <td>{{ $game->id }}</td>
        </tr>
        <tr>
            <td>Edición</td>
        <td>{{ $game->edition_id }}</td>
        </tr>
        <tr>
            <td>Jornada</td>
            <td>{{ $game->match_day }}</td>
        </tr>
        <tr>
            <td>Equipo local</td>
            <td>{{ $game->team_local->name }}</td>
        </tr>
        <tr>
            <td>Equipo visitante</td>
            <td>{{ $game->team_visitor->name }}</td>
        </tr>
        <tr>
            <td>Goles local</td>
            <td>{{ $game->goals_local }}</td>
        </tr>
        <tr>
            <td>Goles visitante</td>
            <td>{{ $game->goals_visitor }}</td>
        </tr>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ route('game.show',$game->id) }}" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                @can('edit')
                <a href="{{ route('game.edit',$game->id) }}" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="inline-block" method="POST" action="{{ route('game.destroy',$game->id) }}">
                    @csrf  
                    @method("delete")
                    <input type="hidden" name="id" value="{{ ( $game->id ?? null ) }}" />
                    <a class="bg-red-500" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-trash"></i>
                    </a>                        
                </form>
                @endcan
            </td>
        </tr>
    </tbody>
</table>
