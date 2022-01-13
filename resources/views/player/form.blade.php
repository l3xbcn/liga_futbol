<?php
    if ( isset ($player->id) ) {
        $method = 'put';
        $action = '/player/update';
    } else {
        $method = 'post';
        $action = '/player/store';
    }    
?>
<form method="POST" action="<?=$action?>">
<input type="hidden" name="id" value="{{ ( $player->id ?? null ) }}">
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
                    <select name="team_id" class="@error('team') is-invalid @enderror">
                        <?php
                            echo '<option value="">Selecciona team</option>';
                        ?>
                        @foreach ($teams as $team)
                        <?php
                            $selected = ( $team->id == ( $player->team_id ?? null) ? 'selected' : '');
                        ?>
                        <option value="{{ $team->id }}"<?=$selected?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @error('team')
                        <div class="form-error">* Selecciona un team</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    name
                </td>
                <td>
                    <input type="text" name="name" value="{{ ( $player->name ?? null ) }}" class="@error('name') is-invalid @enderror">
                </td>
                <td>
                    @error('name')
                        <div class="form-error">* Introduce un name entre 3-50 carácteres. Sólo se aceptan letras, espacios y guiones</div>
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
                            $selected = ( $posicion == ( $player->posicion ?? null ) ? ' selected' : '');
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
