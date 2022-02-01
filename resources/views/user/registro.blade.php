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
            <td>Verificado</td>
            <td>{{ $user->email_verified_at ?? 'No verificado' }}</td>
        <tr>
            <td>Acciones</td>
            <td>
                <a href="{{ route('user.show',$user->id) }}" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('user.edit',$user->id) }}" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="inline-block" method="POST" action="{{ route('user.destroy', $user->id) }}">
                    @csrf  
                    @method("delete")
                    <a class="bg-red-500" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-trash"></i>
                    </a>                        
                </form> 
            </td>
        </tr>
    </tbody>
</table>
