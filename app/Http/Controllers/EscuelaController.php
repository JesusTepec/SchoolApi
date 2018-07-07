<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EscuelaController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calificaciones(Request $request, $idUsuario = false){
        if($request->isJson() and $idUsuario){
            $idAlumno = $idUsuario;
            $calificaciones = Calificacion::select(
                DB::raw("t_alumnos.id_t_usuarios, t_alumnos.nombre, ap_paterno as apellido, t_materias.nombre as materia, calificacion, DATE_FORMAT(fecha_registro, '%d/%m/%Y') as fecha_registro"))
                ->join('t_materias', 't_calificaciones.id_t_materias', '=', 't_materias.id_t_materias')
                ->join('t_alumnos', 't_calificaciones.id_t_usuarios', '=', 't_alumnos.id_t_usuarios')
                ->where('t_calificaciones.id_t_usuarios', "=", $idAlumno)
                ->get();
            if(count($calificaciones) > 0) {
                $calificaciones[] = ['promedio' => array_sum(array_column($calificaciones->toArray(), 'calificacion')) / count($calificaciones)];
            }
            return response()->json($calificaciones   , 200);
        }
        return response()->json(['error' => "no_autorizado"], 401);
    }

    /**
     * Crear una nueva calificacion para una materia de un usuario
     * Se comprueba si el request es de tipo json,
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function crearCalificacion(Request $request){
        if($request->isJson()){
            $dataCalificacion = $request->json()->all();
            if($dataCalificacion['id_t_materias'] and $dataCalificacion['id_t_usuarios'] and is_numeric($dataCalificacion['calificacion'])) {
                $dataCalificacion['fecha_registro'] = Carbon::now();
                Calificacion::create($dataCalificacion);
                return response()->json(['success' => "ok", 'msg' => "calificacion registrada"], 201);
            }
            return response()->json(['error' => "datos_vacios"], 400);
        }
        return response()->json(['error' => "no_autorizado"], 401);
    }

    /**
     * Actualiza la columna calificacion de un registro especificado de t_calificaciones
     * @param Request $request
     * @param bool $idCalificacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function actualizarCalificacion(Request $request, $idCalificacion = false){
        if($request->isJson() and $idCalificacion){
            $dataCalificacion = $request->get('calificacion');
            if(is_numeric($dataCalificacion)) {
                $registroCalificacion = Calificacion::find($idCalificacion);
                if ($registroCalificacion) {
                    $registroCalificacion->calificacion = $dataCalificacion;
                    $registroCalificacion->save();
                    return response()->json(['success' => "ok", 'msg' => "calificacion actualizada"], 200);
                }
                return response()->json(['error' => "no_encontrado", 'msg' => "Registro no encontrado"], 404);
            }
            return response()->json(['error' => "datos_vacios", 'msg' => "Datos vacios o tipos incorrectos"], 400);
        }
        return response()->json(['error' => "no_autorizado"], 401);
    }

    /**
     * Elimina un registro de una calificacion
     * @param Request $request
     * @param bool $idCalificacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminarCalificacion(Request $request, $idCalificacion = false){
        if($request->isJson() and $idCalificacion){
            $registroCalificacion = Calificacion::find($idCalificacion);
            if($registroCalificacion) {
                $registroCalificacion->delete();
                return response()->json(['success' => "ok", 'msg' => "calificacion eliminada"], 200);
            }
            return response()->json(['error' => "no_encontrado", 'msg' => "Registro no encontrado"], 404);
        }
        return response()->json(['error' => "no_autorizado"], 401);
    }

}
