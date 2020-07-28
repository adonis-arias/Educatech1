<?php

namespace App\Http\Controllers;

use App\Nota_Value;
use App\Course;
use App\Nota;
use App\Nota_Structure;
use App\Student;
use App\Period_Range;
use DB;
use Illuminate\Http\Request;

class NotaValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPage()
    {
        $courses = Course::where('period_id',\Session::get('idPeriodo'))
                ->orderBy('nombre','ASC')
                ->get();

        $periods = Period_Range::where('period_id',\Session::get('idPeriodo'))
                ->orderBy('nombre','ASC')
                ->get();

        return view('menus.subirnotas',compact('courses','periods'));
    }

    public function getNotasByCourse($id)
    {
        $notas = nota::orderBy('nombre','ASC')
                  ->where('course_id',$id)->get();//notas
        $subnotas = nota_Structure::orderBy('nombre','ASC')->get();
        return response()->json([
                "notas" => $notas,
                "subnotas" => $subnotas
                ]);
    }

    public function getStudents($id,$idnota)
    {
        \Session::put('idnotaSelect',$idnota);
        \Session::put('idCourseSelect',$id);

        $students = Student::join('courses_students as cs','students.id','=',
                    'cs.student_id')
                    ->select('students.id as idAlumno',
                        DB::raw("CONCAT(students.apellidos,' ',students.nombre) AS 
                            alumno"))
                    ->where('cs.course_id',\Session::get('idCourseSelect'))
                    ->orderBy('alumno','ASC')
                    ->get();

        $subnotas = nota_Structure::where('nota_id',\Session::get('idnotaSelect'))
                    ->orderBy('nombre','ASC')->get();

        $curso = Course::where('id',\Session::get('idCourseSelect'))->first();

        $nota = nota::where('id',\Session::get('idnotaSelect'))->first();

        return view('menus.listaalumnos',
                compact('students','subnotas','curso','nota'));
    }

    public function existsnotaValue($nota,$student,$period)
    {
        $result = nota_Value::where('nota_structures_id',$nota)
                    ->where('student_id',$student)
                    ->where('period_ranges_id',$period)
                    ->first();

        return $result;
    }

    public function save(Request $request)
    {
        $array;
        if($request->ajax())
        {
            if(is_array($request->Alumnos) && is_array($request->Notas)){
                $array = array_combine($request->Alumnos, $request->Notas);
                foreach ($array as $key => $value) {
                    if(!is_null($this->existsnotaValue($request->idSubnota,$key,
                        $request->idPeriodo))){
                        $nota_value = $this->existsnotaValue($request->idSubnota,
                            $key,$request->idPeriodo);
                        $this->updatenotaValue($value,$request->idPeriodo,
                            $nota_value);
                    }else{
                        $this->newnotaValue($value,$request->idSubnota,$key,
                            $request->idPeriodo);
                    }
                }
                return response()->json(["Estado" => "Guardado"]);
            }else{
                if(!is_null($this->existsnotaValue($request->idSubnota,
                    $request->Alumnos,$request->idPeriodo))){
                    $nota_value = $this->existsnotaValue($request->idSubnota,
                            $request->Alumnos,$request->idPeriodo);
                    $this->updatenotaValue($request->Notas,$request->idPeriodo,
                        $nota_value);
                }else
                    $this->newnotaValue($request->Notas,$request->idSubnota,
                        $request->Alumnos,$request->idPeriodo);
                    return response()->json(["Estado" => "Guardado"]);
            }
        }
        return response()->json(["Estado" => "Error"]);
    }

    public function newnotaValue($value,$notaEstructure,$student,$period)
    {
        $nota_value = new nota_Value;
        $nota_value->nota = $value;
        $nota_value->nota_structures_id = $notaEstructure;
        $nota_value->student_id = $student;
        $nota_value->period_ranges_id = $period;
        $nota_value->save();
    }

    public function updatenotaValue($nota,$period,nota_Value $nota_value)
    {
        $nota_value->nota = $nota;
        $nota_value->period_ranges_id = $period;
            if($nota_value->save())
                return response()->json(["Estado" => "Guardado"]);

        return response()->json(["Estado" => "Error"]);   
    }

    public function getnotaStudents($id,$idPeriodo)
    {
        $result = nota_Value::select('id','nota','student_id')
                ->where('nota_structures_id',$id)
                ->where('period_ranges_id',$idPeriodo)
                ->get();
        return $result;
    }
}
