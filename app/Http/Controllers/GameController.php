<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Team;
use App\Events\ModeloEvento;
use Illuminate\Http\Request;

class GameController extends Controller
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
            $games = Game
                ::where('match_day', $search)
                ->paginate(10)
                ->withQueryString()
                ->withPath('/game');
        }
        else{
            $games = Game
                ::paginate(10)
                ->withPath('/game');
        }
        $teams = Team
            ::all();
        return view('game.index', compact('games', 'teams', 'mensaje'));        
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
        return view('game.create', compact('teams'));
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
            'edition_id' => 'required',
            'match_day' => 'required',
            'team_local_id' => 'required',
            'team_visitor_id' => 'required',
            'goals_local' => 'required',
            'goals_visitor' => 'required'
        ]);
        
        $game = new Game();
        $game->edition_id = $request->edition_id;
        $game->match_day = $request->match_day;
        $game->team_local_id = $request->team_local_id;
        $game->team_visitor_id = $request->team_visitor_id;
        $game->goals_local = $request->goals_local;
        $game->goals_visitor = $request->goals_visitor;
        $game->save();
        $mensaje = "Creado partido de la edición $game->edition_id y la jornada $game->match_day";
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
        $game = Game
            ::find($id);
        $teams = Team
            ::all();
        return view('game.show', compact('game','teams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game
            ::find($id);
        $teams = Team
            ::all();
        return view('game.edit', compact('game','teams'));
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
            'edition_id' => 'required',
            'match_day' => 'required',
            'team_local_id' => 'required',
            'team_visitor_id' => 'required',
            'goals_local' => 'required',
            'goals_visitor' => 'required'
        ]);
        $game = Game
            ::find($request->id);
        $game->edition_id = $request->edition_id;
        $game->match_day = $request->match_day;
        $game->team_local_id = $request->team_local_id;
        $game->team_visitor_id = $request->team_visitor_id;
        $game->goals_local = $request->goals_local;
        $game->goals_visitor = $request->goals_visitor;
        $game->save();
        $mensaje = "Editado partido de la edición $game->edition_id y la jornada $game->match_day";
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
        Game::destroy($request->id);
        $mensaje = "Eliminado partido con id: $request->id";
        event(new ModeloEvento($mensaje));
        return $this->index($request, $mensaje);
    }

}