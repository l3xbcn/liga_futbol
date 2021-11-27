<table>
    <thead>
        <tr>
        <th colspan=2>Ficha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID: </td>
            <td>{{ $jugador->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $jugador->nombre }}</td>
        </tr>
        <tr>
            <td>Posición</td>
            <td>{{ $jugador->posicion }}</td>
        </tr>
        <tr>
            <td>Equipo</td>
            <td>{{ $jugador->equipo->nombre }}</td>
        </tr>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ request()->getSchemeAndHttpHost() }}/jugador/<?=$jugador->id?>" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ request()->getSchemeAndHttpHost() }}/jugador/<?=$jugador->id?>/edit" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white">
                    <form class="inline-block" method="POST" action="{{ request()->getSchemeAndHttpHost() }}/jugador/destroy">
                        @csrf  
                        @method("delete")
                        <input type="hidden" name="id" value="{{ ( $jugador->id ?? null ) }}" />
                        <button type="submit" value="" class="bg-red-500 fas fa-trash"></button>
                    </form> 
                </a>
            </td>
        </tr>
    </tbody>
</table>
