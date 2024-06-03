<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:rol-listar')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDatatable $dataTable)
    {
        $this->authorize('rol-listar');
        return $dataTable->render('seguridad.rol');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('rol-crear');

        return view('seguridad.rol-action', ['role' => new Role()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->authorize('rol-crear');
        $registro = new Role();
        $registro->name = $request->name;
        $registro->guard_name = $request->guard_name;
        $registro->save();
        $registro->syncPermissions($request->input('permissions'));
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
    public function show(Role $role)
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
        $this->authorize('rol-editar');
        $role = Role::findOrFail($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('seguridad.rol-action', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $this->authorize('rol-editar');

        $registro = Role::findOrFail($id);


        if ($registro->name == 'Administrador') {
            return response()->json([
                'status' => 'warning',
                'message' => 'Administrador no puede ser actualizado'
            ]);
        }

        $registro->name = $request->name;
        $registro->guard_name = $request->guard_name;
        $registro->save();
        //dd($request->input('permissions'));
        $permissions = [];
        $post_permissions = $request->input('permissions');
        foreach ($post_permissions as $key => $val) {
            $permissions[intval($val)] = intval($val);
        }
        $registro->syncPermissions($permissions);
        //$registro->syncPermissions($request->input('permissions'));
        
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
        $this->authorize('rol-editar');
        $registro = Role::findOrFail($id);

        if ($registro->name == 'Administrador') {
            return response()->json([
                'status' => 'warning',
                'message' => 'Administrador no puede ser eliminado'
            ]);
        }

        $registro->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Eliminación de registro satisfactoria'
        ]);
    }
}
