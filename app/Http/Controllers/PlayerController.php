<?php

namespace App\Http\Controllers;

use App\Events\NotifyEvent;
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

    public function players(Request $request, $team, $mensaje='')
    {
        $search =  $request->input('q');
        if($search!=""){
            $players = Player
                ::where('team_id', '=', $team)
                ->where('name', 'like', '%'.$search.'%')
                ->paginate(10)
                ->withQueryString()
                ->withPath("/team/$team/players");
        }
        else{
            $players = Player
                ::where('team_id', '=', $team)
                ->paginate(10)
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
        $positions = Player::positions();
        return view('player.create', compact('teams','positions'));
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
            'name' => 'required|unique:players,name|min:3|max:100',
            'position' => 'required',
            'team_id' => 'required'
        ]);
        
        $player = new Player();
        $player->team_id = $request->team_id;
        $player->name = $request->name;
        $player->position = $request->position;
        $player->save();
        $mensaje = "Creado player $player->name";
        event(new NotifyEvent($mensaje));
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
        $positions = Player::positions();
        return view('player.edit', compact('player', 'teams', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'position' => 'required|min:1',
            'team_id' => 'required|min:1'
        ]);
        $player = Player
            ::find($id);
        $player->team_id = $request->team_id;
        $player->name = $request->name;
        $player->position = $request->position;
        $player->save();
        $mensaje = "Editado player $player->name";
        event(new NotifyEvent($mensaje));
        return $this->index($request, $mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        Player::destroy($id);
        $mensaje = "Eliminado player con id: $request->id";
        event(new NotifyEvent($mensaje));
        return $this->index($request, $mensaje);
    }
}
