<table>
    <thead>
        <tr>
        <th colspan=2>Ficha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID: </td>
            <td>{{ $player->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $player->name }}</td>
        </tr>
        <tr>
            <td>Posición</td>
            <td>{{ $player->position }}</td>
        </tr>
        <tr>
            <td>Equipo</td>
            <td>{{ $player->team->name }}</td>
        </tr>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ route('player.show',$player->id) }}" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                @can('edit')
                <a href="{{ route('player.edit',$player->id) }}" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="inline-block" method="POST" action="{{ route('player.destroy',$player->id) }}">
                    @csrf  
                    @method("delete")
                    <input type="hidden" name="id" value="{{ ( $player->id ?? null ) }}" />
                    <a class="bg-red-500" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-trash"></i>
                    </a>                        
                </form>
                @endcan 
            </td>
        </tr>
    </tbody>
</table>
