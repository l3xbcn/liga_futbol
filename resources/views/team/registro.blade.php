<table>
    <thead>
        <tr>
        <th colspan=2>Ficha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID: </td>
            <td>{{ $team->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $team->name }}</td>
        </tr>
        <tr>
            <td>Estadio</td>
            <td>{{ $team->stadium }}</td>
        </tr>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ route('team.index') }}/<?=$team->id?>" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('team.index') }}/<?=$team->id?>/edit" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white">
                    <form class="inline-block" method="POST" action="{{ request()->getSchemeAndHttpHost() }}/team/destroy">
                        @csrf  
                        @method("delete")
                        <input type="hidden" name="id" value="{{ ( $team->id ?? null ) }}" />
                        <button type="submit" value="" class="bg-red-500 fas fa-trash"></button>
                    </form> 
                </a>
            </td>
        </tr>
    </tbody>
</table>
