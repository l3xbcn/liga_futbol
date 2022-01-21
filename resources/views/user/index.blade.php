@extends('layouts.common')
@section('title', 'Usuarios | Índice')
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
            <th class="w-3/12">Email</th>
            <th class="w-3/12">Roles</th>
            <th class="w-2/12">Acciones</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @foreach ($roles as $rol)
                    <input type="checkbox" name="roles[]" value={{ $rol->id }} {{ ( $user->hasRole($rol->name) ? 'checked' : '' ) }} disabled>
                    <label>{{ $rol->name }}</label>
                    @endforeach
                </td>
                <td>
                    @can('admin')
                    <a href="{{ request()->getSchemeAndHttpHost() }}/user/<?=$user->id?>" class="bg-blue-500 ">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ request()->getSchemeAndHttpHost() }}/user/<?=$user->id?>/edit" class="bg-yellow-500">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="inline-block" method="POST" action="{{ route('user.destroy',$user->id) }}">
                        @csrf  
                        @method("delete")
                        <input type="hidden" name="id" value="{{ ( $user->id ?? null ) }}" />
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
                <th class="w-3/12">Email</th>
                <th class="w-3/12">Roles</th>
                <th class="w-2/12">Acciones</th>
            </tr>
        </tfoot>        
    </table>
    <script>
    </script>    

    {{ $users->links() }}
@endsection
