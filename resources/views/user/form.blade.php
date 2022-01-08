<?php
    if ( isset ($user->id) ) {
        $method = 'put';
        $action = '/user/update';
    } else {
        $method = 'post';
        $action = '/user/store';
    }    
?>
<form method="POST" action="<?=$action?>">
<input type="hidden" name="id" value="{{ ( $user->id ?? null ) }}">
@csrf  
@method("$method")
    <table>
        <thead>
            <tr>
                <th colspan=3>Formulario</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    Rol
                </td>
                <td>
                    @foreach ($roles as $rol)
                    <input type="checkbox" name="roles[]" value={{ $rol->id }} {{ ( isset($user) ? ( $user->hasRole($rol->name) ? 'checked' : '' ) : '' ) }}>
                    <label>{{ $rol->name }}</label>
                    @endforeach
                </td>
                <td>
                    @error('rol')
                        <div class="form-error">* Selecciona un rol</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    Nombre
                </td>
                <td>
                    <input type="text" name="name" value="{{ ( $user->name ?? null ) }}" class="@error('name') is-invalid @enderror">
                </td>
                <td>
                    @error('name')
                        <div class="form-error">* Introduce un name entre 3-50 carácteres. Sólo se aceptan letras, espacios y guiones</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type="text" name="email" value="{{ ( $user->email ?? null ) }}" class="@error('email') is-invalid @enderror">
                </td>
                <td>
                    @error('email')
                        <div class="form-error">* El email debe ser una nombre de cuenta correcto</div>
                    @enderror
                </td>
            </tr>
            
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input type="password" name="password" value="" placeholder="No es posible recuperarlo de la base" class="@error('password') is-invalid @enderror">
                </td>
                <td>
                    @error('password')
                        <div class="form-error">* El password debe tener entre 8 y 12 caracteres</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td colspan=2>
                    <button type="submit" class="create">Procesar</button>
                </td>
            </tr>

        </tbody>
    </table>
</form>
<div class="form-error">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
