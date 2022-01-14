<?php
    if ( isset ($player->id) ) {
        $method = 'put';
        $action = 'update';
    } else {
        $method = 'post';
        $action = 'store';
    }    
?>
<form method="POST" action="{{ route('player.index') }}/<?=$action?>">
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
                    <select name="position" class="@error('position') is-invalid @enderror">
                        <option value="">Selecciona posición</option>
                        @foreach ($positions as $position)
                            <?php
                            $selected = ( $position == ( $player->position ?? null ) ? ' selected' : '');
                            ?>
                            <option value="{{ $position }}"<?=$selected?>>{{ $position }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @error('position')
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
