<?php

namespace App\Http\Controllers;

use App\Nota;
use App\Course;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function showPage(){
        $cursosConfigurables = Course::select('id','nombre')
            ->where('period_id',\Session::get('idPeriodo'))
            ->get();
        $cursos = Course::select('id','nombre')->orderBy('nombre','ASC')
                ->where('period_id',\Session::get('idPeriodo'))
                ->get();
        return view('menus.notas',compact('cursos','cursosConfigurables'));
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAll()
    {
        return Datatables::of(Nota::join('courses as co','co.id','=','notas.course_id')
            ->select('notas.id as id','co.id as curso_id','notas.nombre as nombre','notas.descripcion as descripcion','co.nombre as curso')
            ->where('co.period_id',\Session::get('idPeriodo'))
            ->get())->make(true);
    }

    
    public function setSession(Request $request)
    {
         $request->session()->put('idNota',$request->id);
         return response()->json(["Sesion"=>"Asignado"]);
    }


    public function save(Request $request)
    {
        if ($request->ajax()){
            if ($request->Accion == "Registrar") {
                $not              = new Nota;
                $not->nombre      = $request->Nombre;
                $not->descripcion = $request->Descripcion;
                $curso = Course::find($request->Curso);

                if($curso->notas()->save($not))
                    return response()->json(["Estado"=>"Registrado"]);
                else
                    return response()->json(["Estado"=>"Error"]);    
            
            }else if($request->Accion == "Editar"){
                $not              = Nota::find($request->session()->get('idNota'));
                $not->nombre      = $request->Nombre;
                $not->descripcion = $request->Descripcion;
                $curso = Course::find($request->Curso);
                if($curso->Notas()->save($not))
                    return response()->json(["Estado"=>"Editado"]);
                else
                    return response()->json(["Estado"=>"Error"]);    
            } 
            $request->session()->forget('idNota');
        }else
            return response()->json(["Estado"=>"Error"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Period  $period
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $not = Nota::find($request->id);
        if (!is_null($not)) {
            $not->delete();
            return response()->json(["Estado"=>"Eliminado"]);
        }
            return response()->json(["Estado"=>"Error"]);
    }
}
