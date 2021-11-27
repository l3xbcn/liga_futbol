<?php
    if ( isset ($jugador->id) ) {
        $method = 'put';
        $action = '/jugador/update';
    } else {
        $method = 'post';
        $action = '/jugador/store';
    }    
?>
<form method="POST" action="<?=$action?>">
<input type="hidden" name="id" value="{{ ( $jugador->id ?? null ) }}">
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
                    Equipo
                </td>
                <td>
                    <select name="id_equipo" class="@error('equipo') is-invalid @enderror">
                        <?php
                            echo '<option value="">Selecciona equipo</option>';
                        ?>
                        @foreach ($equipos as $equipo)
                        <?php
                            $selected = ( $equipo->id == ( $jugador->id_equipo ?? null) ? 'selected' : '');
                        ?>
                        <option value="{{ $equipo->id }}"<?=$selected?>>{{ $equipo->nombre }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @error('equipo')
                        <div class="form-error">* Selecciona un equipo</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    Nombre
                </td>
                <td>
                    <input type="text" name="nombre" value="{{ ( $jugador->nombre ?? null ) }}" class="@error('nombre') is-invalid @enderror">
                </td>
                <td>
                    @error('nombre')
                        <div class="form-error">* Introduce un nombre entre 3-50 carácteres. Sólo se aceptan letras, espacios y guiones</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    Posición
                </td>
                <td>
                    <select name="posicion" class="@error('posicion') is-invalid @enderror">
                        <?php
                        $posiciones = array('entrenador','portero','defensa','centrocampista','delantero');
                        echo '<option value="">Selecciona posición</option>';
                        foreach ($posiciones as $posicion) {
                            $selected = ( $posicion == ( $jugador->posicion ?? null ) ? ' selected' : '');
                            echo "<option value=\"$posicion\"$selected>$posicion</option>";
                        }
                        ?>                
                    </select>
                </td>
                <td>
                    @error('posicion')
                        <div class="form-error">* Selecciona una posición</div>
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
