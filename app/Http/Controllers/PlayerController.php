<?php

namespace App\Http\Controllers;

use App\Events\ModeloEvento;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $mensaje = '')
    {
        $search =  $request->input('q');
        if($search!=""){
            $players = Player
                ::where('name', 'like', '%'.$search.'%')
                ->paginate(10)
                ->withQueryString()
                ->withPath('/player');
        }
        else{
            $players = Player
                ::paginate(10)
                ->withPath('/player');
        }
        return view('player.index', compact('players', 'mensaje'));        
    }

    public function team_index(Request $request, $team)
    {
        dd('No estoy aquí');
        $search =  $request->input('q');
        if($search!=""){
            $players = Player
                ::where('team_id', '=', $team)
                ::and('name', 'like', '%'.$search.'%')
                ->paginate(10)
                ->withQueryString()
                ->withPath("/team/$team/players");
        }
        else{
            $players = Player
                ::where('team_id', '=', $team)
                ::paginate(10)
                ->withPath("/team/$team/players");
        }
        return view('player.index', compact('players', 'mensaje'));        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team
            ::all();
        return view('player.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:players,name|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'posicion' => 'required',
            'id_team' => 'required'
        ]);
        
        $player = new Player();
        $player->id_team = $request->id_team;
        $player->name = $request->name;
        $player->posicion = $request->posicion;
        $player->save();
        $mensaje = "Creado player $player->name";
        event(new ModeloEvento($mensaje));
        return $this->index($request, $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $player = Player
            ::find($id);
        return view('player.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player
            ::find($id);
        $teams = Team
            ::all();
        return view('player.edit', compact('player', 'teams'));
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
            'name' => 'required|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'posicion' => 'required|min:1',
            'id_team' => 'required|min:1'
        ]);
        $player = Player
            ::find($request->id);
        $player->id_team = $request->id_team;
        $player->name = $request->name;
        $player->posicion = $request->posicion;
        $player->save();
        $mensaje = "Editado player $player->name";
        event(new ModeloEvento($mensaje));
        return $this->index($request, $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Player::destroy($request->id);
        $mensaje = "Eliminado player con id: $request->id";
        event(new ModeloEvento($mensaje));
        return $this->index($request, $mensaje);
    }
}
