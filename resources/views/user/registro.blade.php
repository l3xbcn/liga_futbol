<table>
    <thead>
        <tr>
        <th colspan=2>Ficha</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>ID: </td>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td>Roles</td>
            <td></td>
        </tr>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ request()->getSchemeAndHttpHost() }}/user/<?=$user->id?>" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ request()->getSchemeAndHttpHost() }}/user/<?=$user->id?>/edit" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <a class="bg-red-500 cursor-pointer rounded p-1 mx-1 text-white">
                    <form class="inline-block" method="POST" action="{{ request()->getSchemeAndHttpHost() }}/user/destroy">
                        @csrf  
                        @method("delete")
                        <input type="hidden" name="id" value="{{ ( $user->id ?? null ) }}" />
                        <button type="submit" value="" class="bg-red-500 fas fa-trash"></button>
                    </form> 
                </a>
            </td>
        </tr>
    </tbody>
</table>
