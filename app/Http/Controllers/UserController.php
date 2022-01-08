<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
            $users = User
                ::where('name', 'like', '%'.$search.'%')
                ->paginate(10)
                ->withQueryString()
                ->withPath('/user');
        }
        else{
            $users = User
                ::paginate(10)
                ->withPath('/user');
        }
        $roles = Role::all();
        return view('user.index', compact('users', 'roles', 'mensaje'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
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
            'name' => 'required|unique:users,name|min:3|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:50'
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->sync($request->roles);
        $mensaje = "Creado user $user->name";
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
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
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
            'email' => 'required|email',
            'password' => 'required|min:5|max:50'
        ]);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->sync($request->roles);
        $mensaje = "Editado user $user->name";
        /* return redirect(request()->getSchemeAndHttpHost().'/user' ); */
        return $this->index($request, $mensaje);

        /*
        $users = User::all();
        return view('user.index', compact('users', 'mensaje'));
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
        User::destroy($request->id);
        $mensaje = "Eliminado user con id: $request->id";
        return $this->index($request, $mensaje);
    }
}

