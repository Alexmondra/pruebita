<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\DataTables\CategoriaDataTable;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('can:categoria-listar')->only('index');
    }

    public function index(CategoriaDataTable $dataTable)
    {
        $this->authorize('categoria-listar');
        return $dataTable->render('almacen.categoria');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('categoria-crear');
        $categoria= new Categoria();
        return view('almacen.categoria-action',['categoria'=>new Categoria()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        $this->authorize('categoria-crear');
        $registro = new Categoria();
        $registro->nombre = $request->nombre;

        // Imagen
        $sufijo = Str::random(2);
        $image = $request->file('imagen');
        
        if (!is_null($image)) {
            $nombreImagen = $sufijo . '-' . $image->getClientOriginalName();
            $image->move('uploads/categorias', $nombreImagen);
            $registro->imagen = $nombreImagen;
        } else {
            $registro->imagen = null;
        }

        $registro->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Registro creado satisfactoriamente'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categoria=Categoria::findOrFail($id);
        $this->authorize('categoria-editar');
        return view('almacen.categoria-action',compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, $id)
    {
        $this->authorize('categoria-editar');
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->nombre;
        //Imagen
        $sufijo=Str::random(2);  
        $image = $request->file('imagen');              
        if (!is_null($image)){ 
            $nombreImagen=$sufijo.'-'.$image->getClientOriginalName();
            $image->move('uploads/categorias', $nombreImagen);            
            $old_image = 'uploads/categorias/'.$categoria->imagen;
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
            $categoria->imagen = $nombreImagen;
        }
        $categoria->save();

        return response()->json([
            'status'=> 'success',
            'message'=> 'Actualización de datos satisfactoria'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->authorize('categoria-activar');
        $registro=Categoria::findOrFail($id);
        $mensaje="";
        $registro->activo=!$registro->activo;
        $registro->activo ? $mensaje="Activación" : $mensaje="Desactivación";
        $registro->save();

        return response()->json([
            'status'=> 'success',
            'message'=> $mensaje .' de registro satisfactoria'
        ]);
    }
}
