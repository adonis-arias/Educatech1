<?php

namespace App\Http\Controllers;

use App\Nota_Structure;
use App\Nota;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
class NotaStructureController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function setSession(Request $request)
    {
         $request->session()->put('idNotaSet',$request->id);
         $nota = Nota::select('nombre')->where('id',$request->session()->get('idNotaSet'))->first();
         return response()->json(["Sesion"=>"Asignado","NombreNota"=>$nota->nombre]);
    }

    public function setSessionStructure(Request $request)
    {
        $request->session()->put('idNotaStructure',$request->id);
        return response()->json(["Sesion"=>"Asignado"]);
    }


    public function listAll(Request $request)
    {
        return Datatables::of(Nota_Structure::select('id','nombre')
            ->where('nota_id',$request->session()->get('idNotaSet'))
            ->get())->make(true);
    }


    public function save(Request $request)
    {
        if ($request->ajax()) {
            if ($request->AccionSubNota == "RegistrarSubNota") {
                $nots              = new Nota_Structure;
                $nots->nombre      = $request->NombreSubNota;
                $nota = Nota::find($request->session()->get('idNotaSet'));
                if($nota->notas_structures()->save($nots))
                    return response()->json(["Estado"=>"Registrado"]);
                else
                    return response()->json(["Estado"=>"Error"]);    
            
            }else if($request->AccionSubNota == "EditarSubNota"){
                $nots              = Nota_Structure::find($request->session()->get('idNotaStructure'));
                $nots->nombre      = $request->NombreSubNota;
                $nota = Nota::find($request->session()->get('idNotaSet'));
                if($nota->notas_structures()->save($nots))
                    return response()->json(["Estado"=>"Editado"]);
                else
                    return response()->json(["Estado"=>"Error"]);    
            }
            $request->session()->forget('idNotaStructure');
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
        $nots = Nota_Structure::find($request->id);
        if (!is_null($nots)) {
            $nots->delete();
            return response()->json(["Estado"=>"Eliminado"]);
        }
            return response()->json(["Estado"=>"Error"]);
    }
}
