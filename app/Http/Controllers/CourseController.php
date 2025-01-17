<?php

namespace App\Http\Controllers;

use App\Course;
use App\Period;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;
use \Auth;
class CourseController extends Controller
{
    public function showPage()
    {
        $lista_cursos = $this->getCursosxAlumno();
        return view('cursos',compact('lista_cursos'));
    }

    public function getCursosxAlumno()
    {
        $user_email = Auth::user()->email;
        $lista_cursos = Course::join('courses_students as cs','courses.id','=','cs.course_id')
                        ->join('students as s','cs.student_id','s.id')
                        ->select('courses.nombre as nombre', 'courses.descripcion as descripcion','cs.student_id')
                        ->where('s.email','=',$user_email)
                        ->get();
        return $lista_cursos;
    }

    public function listAll()
    {
        return Datatables::of(Course::join('periods as pe','pe.id','=','courses.period_id')
            ->select('courses.id as id',
                'courses.period_id as periodo_id','courses.nombre as nombre',
                'courses.descripcion as descripcion','pe.nombre as periodo')
            ->where('period_id',\Session::get('idPeriodo'))
            ->get())->make(true);
    }

    
    public function setSession(Request $request)
    {
         $request->session()->put('idCourse',$request->id);
         return response()->json(["Sesion"=>"Asignado"]);
    }


    public function save(Request $request)
    {
        if ($request->ajax()) {
            if ($request->Accion == "Registrar") {
                $co              = new Course;
                $co->nombre      = $request->Nombre;
                $co->descripcion = $request->Descripcion;
                $periodo = Period::find(\Session::get('idPeriodo'));

                if($periodo->courses()->save($co))
                {
                    return response()->json(["Estado"=>"Registrado"]);
                }
                else
                    return response()->json(["Estado"=>"Error"]);    
            
            }else if($request->Accion == "Editar"){
                $co              = Course::find($request->session()->get('idCourse'));
                $co->nombre      = $request->Nombre;
                $co->descripcion = $request->Descripcion;
                $periodo = Period::find(\Session::get('idPeriodo'));

                if($periodo->courses()->save($co))
                    return response()->json(["Estado"=>"Editado"]);
                else
                    return response()->json(["Estado"=>"Error"]);    
            } 
            $request->session()->forget('idCourse');
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
        $co = Course::find($request->id);
        if (!is_null($co)) {
            $co->delete();
            return response()->json(["Estado"=>"Eliminado"]);
        }
            return response()->json(["Estado"=>"Error"]);
    }
}
