<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;
use App\DataTables\SolicitudDataTable;
use Illuminate\Support\Str;

class SolicitudController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:solicitud-listar')->only('index');
    }

    public function index(SolicitudDataTable $dataTable)
    {
        $this->authorize('solicitud-listar');
        return $dataTable->render('solicitud.solicitud');
    }

    public function create()
    {
        $this->authorize('solicitud-crear');
        $solicitud = new Solicitud();
        return view('solicitud.solicitud-action', ['solicitud' => new Solicitud()]);
    }

    public function store(Request $request)
    {
        $this->authorize('solicitud-crear');
        
        $registro = new Solicitud();
        $registro->user_id = auth()->id();
        $registro->tipo = $request->tipo;
        $registro->comentario = $request->comentario;
        $registro->observaciones = $request->observaciones;
        $registro->fecha_envio = now(); 
        $registro->estado = "pendiente";
    
        // Archivo adjunto
        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombreArchivo = Str::random(2) . '-' . $archivo->getClientOriginalName();
            $archivo->move('uploads/solicitudes', $nombreArchivo);
            $registro->archivo = $nombreArchivo;
        } else {
            $registro->archivo = null;
        }
    
        $registro->save();
    
        return response()->json([
            'status' => 'success',
            'message' => 'Solicitud registrada satisfactoriamente'
        ]);
    }
    
    
    public function show(Solicitud $solicitud)
    {
        //
    }

    public function edit($id)
    {
        $solicitud = Solicitud::findOrFail($id);
        $this->authorize('solicitud-editar');
        return view('solicitud.solicitud-action', compact('solicitud'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('solicitud-editar');
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->user_id_rpta = auth()->id();
        $solicitud->observaciones = $request->observaciones;
        $solicitud->estado = $request->estado;
 
        $solicitud->save();
        
        return response()->json([
            'status'=> 'success',
            'message'=> 'Actualización de la solicitud satisfactoria'
        ]);
    }
    

    public function destroy($id)
    {
        $this->authorize('solicitud-activar');
        $registro = Solicitud::findOrFail($id);
        $mensaje = "";
        $registro->estado = $registro->estado === 'Aprobado' ? 'Rechazado' : 'Aprobado';
        $registro->estado === 'Aprobado' ? $mensaje = "Activación" : $mensaje = "Desactivación";
        $registro->save();

        return response()->json([
            'status' => 'success',
            'message' => $mensaje . ' de registro satisfactoria'
        ]);
    }
}
