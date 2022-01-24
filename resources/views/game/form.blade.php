<?php
    if ( isset ($game->id) ) {
        $method = 'put';
        $action = 'update';
    } else {
        $method = 'post';
        $action = 'store';
    }    
?>
<form method="POST" action="{{ route('game.index') }}/<?=$action?>">
<input type="hidden" name="id" value="{{ ( $game->id ?? null ) }}">
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
                    Edición
                </td>
                <td>
                    <select name="edition_id" class="@error('edition_id') is-invalid @enderror">
                        <?php
                            echo '<option value="">Selecciona una edición</option>';
                        ?>
                        @foreach ($editions as $edition)
                        <?php
                            $selected = ( $edition->id == ( $game->edition_id ?? null) ? ' selected' : '');
                        ?>
                        <option value={{ $edition->id }}<?=$selected?>>{{ $edition->id }} ( {{ $edition->start }} - {{ $edition->end }} )</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @error('edition_id')
                        <div class="form-error">* Selecciona la edición</div>
                    @enderror
                </td>
            </tr>            

            <tr>
                <td>
                    Jornada
                </td>
                <td>
                    <input type="text" name="match_day" value="{{ ( $game->match_day ?? null ) }}" class="@error('match_day') is-invalid @enderror">
                </td>
                <td>
                    @error('match_day')
                        <div class="form-error">* Introduce la jornada</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    Equipo local
                </td>
                <td>
                    <select name="team_local_id" class="@error('team_local_id') is-invalid @enderror">
                        <?php
                            echo '<option value="">Seleccion equipo local</option>';
                        ?>
                        @foreach ($teams as $team)
                        <?php
                            $selected = ( $team->id == ( $game->team_local_id ?? null) ? 'selected' : '');
                        ?>
                        <option value="{{ $team->id }}"<?=$selected?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @error('team_local_id')
                        <div class="form-error">* Selecciona un equipo local</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    Equipo visitante
                </td>
                <td>
                    <select name="team_visitor_id" class="@error('team_visitor_id') is-invalid @enderror">
                        <?php
                            echo '<option value="">Selecciona team</option>';
                        ?>
                        @foreach ($teams as $team)
                        <?php
                            $selected = ( $team->id == ( $game->team_visitor_id ?? null) ? 'selected' : '');
                        ?>
                        <option value="{{ $team->id }}"<?=$selected?>>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @error('team_visitor_id')
                        <div class="form-error">* Selecciona un equipo visitante</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    Goles local
                </td>
                <td>
                    <input type="text" name="goals_local" value="{{ ( $game->goals_local ?? null ) }}" class="@error('goals_local') is-invalid @enderror">
                </td>
                <td>
                    @error('goals_local')
                        <div class="form-error">* Introduce goles del equipo local</div>
                    @enderror
                </td>
            </tr>

            <tr>
                <td>
                    Goles visitante
                </td>
                <td>
                    <input type="text" name="goals_visitor" value="{{ ( $game->goals_visitor ?? null ) }}" class="@error('goals_visitor') is-invalid @enderror">
                </td>
                <td>
                    @error('goals_visitor')
                        <div class="form-error">* Introduce goles del equipo visitante</div>
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
