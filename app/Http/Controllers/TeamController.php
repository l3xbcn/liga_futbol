<?php

namespace App\Http\Controllers;

use App\Events\ModeloEvento;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
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
            $teams = Team
                ::where('name', 'like', '%'.$search.'%')
                ->paginate(10)
                ->withQueryString()
                ->withPath('/team');
        }
        else{
            $teams = Team
                ::paginate(10)
                ->withPath('/team');
        }
        return view('team.index', compact('teams', 'mensaje'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
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
            'name' => 'required|unique:teams,name|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'stadium' => 'required|unique:teams,stadium|min:3|max:50|regex:/^[\pL\s\-]+$/u'
        ]);
        
        $team = new Team();
        $team->name = $request->name;
        $team->stadium = $request->stadium;
        $team->save();
        $mensaje = "Creado team $team->name";
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
        $team = Team
            ::find($id);
        return view('team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team
            ::find($id);
        return view('team.edit', compact('team'));
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
            'name' => 'required|unique:teams,name|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'stadium' => 'required|unique:teams,stadium|min:3|max:50|regex:/^[\pL\s\-]+$/u'
        ]);
        $team = Team
            ::find($request->id);
        $team->name = $request->name;
        $team->stadium = $request->stadium;
        $team->save();
        $mensaje = "Editado team $team->name";
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
        Team::destroy($request->id);
        $mensaje = "Eliminado team con id: $request->id";
        event(new ModeloEvento($mensaje));
        return $this->index($request, $mensaje);
    }
}
