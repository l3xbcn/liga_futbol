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
                <a href="{{ route('team.show',$team->id) }}" class="bg-blue-500">
                    <i class="fas fa-eye"></i>
                </a>
                @can('edit')
                <a href="{{ route('team.edit',$team->id) }}" class="bg-yellow-500">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="inline-block" method="POST" action="{{ route('team.destroy',$team->id) }}">
                    @csrf  
                    @method("delete")
                    <input type="hidden" name="id" value="{{ ( $team->id ?? null ) }}" />
                    <a class="bg-red-500" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fas fa-trash"></i>
                    </a>                        
                </form>
                @endcan
            </td>
        </tr>
    </tbody>
</table>
