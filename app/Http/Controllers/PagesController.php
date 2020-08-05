<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inicio()
    {

        $Terminadas = App\EstatusTarea::where('id', '>', 0)->pluck('tarea_id')->toArray();

        if($Terminadas != null){

           $tareas= App\Tarea::whereNotIn('id', $Terminadas)->get();

        }
        else{
            $tareas = App\Tarea::all();
        }



        return view('welcome', compact('tareas'));
    }

    public function crear(Request $request){

        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required'
        ]);

        $nuevaTarea = new App\Tarea;
        $nuevaTarea->nombre = $request->nombre;
        $nuevaTarea->descripcion = $request->descripcion;

        $nuevaTarea->save();

        return back()->with('mensaje', 'Tarea agregada!');
    }

    public function editar($id){


        $tarea = App\Tarea::findOrFail($id);

        return view('tareas.editar', compact('tarea'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required'
        ]);

        $updateTarea = App\Tarea::findOrFail($id);
        $updateTarea->nombre = $request->nombre;
        $updateTarea->descripcion = $request->descripcion;

        $updateTarea->save();

        return back()->with('mensaje', 'Tarea actualizada');
    }

    public function eliminar($id){

        $eliminarTarea = App\Tarea::findOrFail($id);
        $eliminarTarea->delete();

        return back()->with('mensaje', 'Tarea eliminada');
    }

    public function terminar($id){

        $terminarTarea = new App\EstatusTarea;
        $terminarTarea->estatus = 'terminado';
        $terminarTarea->tarea_id = $id;
        $terminarTarea->save();

        return back()->with('mensaje', 'Tarea terminada');
    }

}
