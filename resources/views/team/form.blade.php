<?php
    if ( isset ($team->id) ) {
        $method = 'put';
        $action = '/team/update';
    } else {
        $method = 'post';
        $action = '/team/store';
    }    
?>
<form method="POST" action="<?=$action?>">
<input type="hidden" name="id" value="{{ ( $team->id ?? null ) }}">
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
                    Nombre
                </td>
                <td>
                    <input type="text" name="name" value="{{ ( $team->name ?? null ) }}" class="@error('name') is-invalid @enderror">
                </td>
                <td>
                    @error('name')
                        <div class="form-error">* Introduce un name entre 3-50 carácteres. Sólo se aceptan letras, espacios y guiones</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    Estadio
                </td>
                <td>
                    <input type="text" name="stadium" value="{{ ( $team->stadium ?? null ) }}" class="@error('stadium') is-invalid @enderror">
                </td>
                <td>
                    @error('stadium')
                        <div class="form-error">* Introduce un name entre 3-50 carácteres. Sólo se aceptan letras, espacios y guiones</div>
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
