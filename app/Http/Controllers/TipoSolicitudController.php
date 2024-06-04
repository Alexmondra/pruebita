<?php

namespace App\Http\Controllers;

use App\Models\TipoSolicitud;
use Illuminate\Http\Request;
use App\DataTables\TipoSolicitudDataTable;
use App\Http\Requests\TipoSolicitudRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TipoSolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tiposolicitud-listar')->only('index');
    }

    public function index(TipoSolicitudDataTable $dataTable)
    {
        $this->authorize('tiposolicitud-listar');
        return $dataTable->render('tipoSol.tipoSolicitud');
    }

    public function create()
    {
        $this->authorize('tiposolicitud-crear');
        return view('tipoSol.tipoSolicitud-action', ['tipoSolicitud' => new TipoSolicitud()]);
    }

    public function store(TipoSolicitudRequest $request)
    {
        $this->authorize('tiposolicitud-crear');
        $registro = new TipoSolicitud();
        $registro->nombre = $request->nombre;

        // Guardar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::random(10) . '.' . $imagen->getClientOriginalExtension();
            $imagen->storeAs('uploads/tipoSolicitudes', $nombreImagen);
            $registro->imagen = $nombreImagen;
        }

        $registro->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Registro creado satisfactoriamente'
        ]);
    }

    public function edit($id)
    {
        $tipoSolicitud = TipoSolicitud::findOrFail($id);
        $this->authorize('tiposolicitud-editar');
        return view('tipoSol.tipoSolicitud-action', compact('tipoSolicitud'));
    }

    public function update(TipoSolicitudRequest $request, $id)
    {
        $this->authorize('tiposolicitud-editar');
        $tipoSolicitud = TipoSolicitud::findOrFail($id);
        $tipoSolicitud->nombre = $request->nombre;

        // Actualizar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::random(10) . '.' . $imagen->getClientOriginalExtension();

            // Eliminar la imagen anterior si existe
            if ($tipoSolicitud->imagen) {
                Storage::delete('uploads/tipoSolicitudes/' . $tipoSolicitud->imagen);
            }

            // Guardar la nueva imagen
            $imagen->storeAs('uploads/tipoSolicitudes', $nombreImagen);
            $tipoSolicitud->imagen = $nombreImagen;
        }

        $tipoSolicitud->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Actualización de datos satisfactoria'
        ]);
    }

    public function destroy($id)
    {
        $this->authorize('tiposolicitud-activar');
        $registro = TipoSolicitud::findOrFail($id);
        $mensaje = $registro->activo ? "Desactivación" : "Activación";
        $registro->activo = !$registro->activo;
        $registro->save();

        return response()->json([
            'status' => 'success',
            'message' => $mensaje . ' de registro satisfactoria'
        ]);
    }
}
