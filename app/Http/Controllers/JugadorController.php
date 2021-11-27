<?php

namespace App\Http\Controllers;

use App\Events\ModeloEvento;
use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mensaje = '')
    {
        $jugadores = Jugador::all();
        return view('jugador.index', compact('jugadores', 'mensaje'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipos = Equipo::all();
        return view('jugador.create', compact('equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|unique:jugadors,nombre|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'posicion' => 'required',
            'id_equipo' => 'required'
        ]);
        
        $jugador = new Jugador();
        $jugador->id_equipo = $request->id_equipo;
        $jugador->nombre = $request->nombre;
        $jugador->posicion = $request->posicion;
        $jugador->save();
        $mensaje = "Creado jugador $jugador->nombre";
        event(new ModeloEvento($mensaje));
        return $this->index($mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $jugador = Jugador::find($id);
        return view('jugador.show', compact('jugador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jugador = Jugador::find($id);
        $equipos = Equipo::all();
        return view('jugador.edit', compact('jugador', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'posicion' => 'required|min:1',
            'id_equipo' => 'required|min:1'
        ]);
        $jugador = Jugador::find($request->id);
        $jugador->id_equipo = $request->id_equipo;
        $jugador->nombre = $request->nombre;
        $jugador->posicion = $request->posicion;
        $jugador->save();
        $mensaje = "Editado jugador $jugador->nombre";
        event(new ModeloEvento($mensaje));
        return $this->index($mensaje);
        /*
        $jugadores = Jugador::all();
        return view('jugador.index', compact('jugadores', 'mensaje'));
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Jugador::destroy($request->id);
        $mensaje = "Eliminado jugador con id: $request->id";
        event(new ModeloEvento($mensaje));
        return $this->index($mensaje);
    }
}
