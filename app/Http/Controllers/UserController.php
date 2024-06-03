<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:usuario-listar')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        $this->authorize('usuario-listar');
        return $dataTable->render('seguridad.usuario');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('usuario-crear');

        $roles = Role::pluck('name', 'name')->all();
        return view('seguridad.usuario-action', ['user' => new User(), 'roles' => $roles, 'userRole' => array()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('usuario-crear');
        $registro = new User();
        $registro->name = $request->name;
        $registro->email = $request->email;
        $registro->password = bcrypt($request->password);
        $registro->save();
        $registro->assignRole($request->input('roles'));
        return response()->json([
            'status' => 'success',
            'message' => 'Registro creado satisfactoriamente'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('usuario-editar');
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('seguridad.usuario-action', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('usuario-editar');
        $registro = User::findOrFail($id);
        $registro->name = $request->name;
        $registro->email = $request->email;

        if ($request->password) {
            $registro->password = bcrypt($request->password);
        }

        $registro->save();

        $is_admin = false;

        foreach ($registro->roles as $key => $role) {
            if ($role->name == 'Administrador') {
                $is_admin = true;
            }
        }

        if ($is_admin) {
            $admin_count = User::role('Administrador')->get()->count();

            if ($admin_count == 1) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Añade un nuevo usuario como administrador para poder actualizar el rol del registro'
                ]);
            }
        }

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $registro->assignRole($request->input('roles'));

        return response()->json([
            'status' => 'success',
            'message' => 'Actualización de datos satisfactoria',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*
        $this->authorize('usuario-activar');

        $registro = User::findOrFail($id);

        $is_admin = false;

        foreach ($registro->roles as $key => $role) {
            if ($role->name == 'Administrador') {
                $is_admin = true;
            }
        }


        if ($is_admin) {
            $admin_count = User::role('Administrador')->get()->count();

            if ($admin_count == 1) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Añade un nuevo usuario como administrador para poder eliminar el registro.'
                ]);
            }
        }

        $registro->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Eliminación de registro satisfactoria'
        ]);
        */
    }
}
