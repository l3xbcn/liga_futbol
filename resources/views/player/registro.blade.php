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
            <td>{{ $player->posicion }}</td>
        </tr>
        <tr>
            <td>Equipo</td>
            <td>{{ $player->team->name }}</td>
        </tr>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ request()->getSchemeAndHttpHost() }}/player/<?=$player->id?>" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ request()->getSchemeAndHttpHost() }}/player/<?=$player->id?>/edit" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white">
                    <form class="inline-block" method="POST" action="{{ request()->getSchemeAndHttpHost() }}/player/destroy">
                        @csrf  
                        @method("delete")
                        <input type="hidden" name="id" value="{{ ( $player->id ?? null ) }}" />
                        <button type="submit" value="" class="bg-red-500 fas fa-trash"></button>
                    </form> 
                </a>
            </td>
        </tr>
    </tbody>
</table>
