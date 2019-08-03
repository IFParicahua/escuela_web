<?php

namespace App\Http\Controllers;


use App\Areas;
use App\Gestiones;
use App\Niveles;
use App\TipoCalificaciones;
use App\Turnos;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdministradorController extends Controller
{
    //VISTAS
    public function index()
    {
        return view('Administrador');
    }

    public function area()
    {
        $areas = Areas::all();
        return view('AdminAreas', ['areas' => $areas]);
    }

    public function nivel()
    {
        $niveles = Niveles::all();
        return view('AdminNiveles', ['niveles' => $niveles]);
    }

    public function turno()
    {
        $turnos = Turnos::all();
        return view('AdminTurnos', ['turnos' => $turnos]);
    }

    public function gestion()
    {
        $gestiones = Gestiones::all();
        return view('AdminGestiones', ['gestiones' => $gestiones]);
    }

    public function tipocalificacion()
    {
        $TCalificaciones = TipoCalificaciones::all();
        return view('AdminTipoCalificaciones', ['TCalificaciones' => $TCalificaciones]);
    }

    //GUARDAR
    public function AreaCreate(Request $request)
    {
        $areas = new Areas;
        $areas->nombre = $request->input('nombre');
        $areas->estado = '0';
        $areas->save();
        return back();
    }

    public function NivelesCreate(Request $request)
    {
        $nivel = new Niveles;
        $nivel->nombre = $request->input('nombre');
        $nivel->estado = '0';
        $nivel->save();
        return back();
    }

    public function TurnosCreate(Request $request)
    {
        $turno = new Turnos;
        $turno->nombre = $request->input('nombre');
        $turno->estado = '0';
        $turno->save();
        return back();
    }

    public function GestionCreate(Request $request)
    {
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $estado = Gestiones::where('estado', '0')->value('nombre');
        $date_inicio = Gestiones::where([
            ['fecha_inicial', '<=', $inicio],
            ['fecha_final', '>=', $inicio],
        ])->value('fecha_final');
        $date_fin = Gestiones::where(([
            ['fecha_inicial', '<=', $fin],
            ['fecha_final', '>=', $fin],
        ]))->value('fecha_inicial');
        $date_entre = Gestiones::where(([
            ['fecha_inicial', '>', $inicio],
            ['fecha_final', '<', $fin],
        ]))->count();

        $validator = Validator::make($request->all(), [
            'fin' => 'after:inicio'
        ]);
        if ($date_inicio > 0) {
            if ($date_fin > 0) {
                $notificacion = array(
                    'message' => 'La fecha de inicio y fin estan en un rango existente',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $notificacion = array(
                    'message' => 'La fecha de inicio esta en un rango existente',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            }
        } else {
            if ($date_fin > 0) {
                $notificacion = array(
                    'message' => 'La fecha de fin esta en un rango existente',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                if ($date_entre > 0) {
                    $notificacion = array(
                        'message' => 'Existen gestiones dentro del rango de fechas',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    if ($validator->fails()) {
                        $notificacion = array(
                            'message' => 'La fecha de inicio debe ser menor a la fecha final',
                            'alert-type' => 'error'
                        );
                        return back()->with($notificacion)
                            ->with('error_code', 1)
                            ->withInput();
                    } else {
                        if ($estado == true) {
                            $notificacion = array(
                                'message' => 'No se puede guardar ya que existe una Gestion Abierta',
                                'alert-type' => 'error'
                            );
                            return back()->with($notificacion)
                                ->with('error_code', 1)
                                ->withInput();
                        } else {
                            $gestion = new Gestiones;
                            $gestion->nombre = $request->input('nombre');
                            $gestion->fecha_inicial = $request->input('inicio');
                            $gestion->fecha_final = $request->input('fin');
                            $gestion->descripcion = $request->input('descripcion');
                            $gestion->estado = '0';
                            $gestion->save();
                            return back();
                        }
                    }
                }
            }
        }
    }

    public function TcalificacionCreate(Request $request)
    {
        $inicio = $request->input('inicio');
        $fin = $request->input('fin');
        $date_inicio = TipoCalificaciones::where(([
            ['fecha_inicial', '<=', $inicio],
            ['fecha_final', '>=', $inicio],
        ]))->value('fecha_final');
        $date_fin = TipoCalificaciones::where(([
            ['fecha_inicial', '<=', $fin],
            ['fecha_final', '>=', $fin],
        ]))->value('fecha_inicial');
        $date_entre = TipoCalificaciones::where(([
            ['fecha_inicial', '>', $inicio],
            ['fecha_final', '<', $fin],
        ]))->count();

        $validator = Validator::make($request->all(), [
            'fin' => 'after:inicio'
        ]);
        if ($date_inicio > 0) {
            if ($date_fin > 0) {
                $notificacion = array(
                    'message' => 'Las fechas de inicio y finalizacion estan en un rango existente',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $notificacion = array(
                    'message' => 'La fecha de inicio esta en un rango existente',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            }
        } else {
            if ($date_fin > 0) {
                $notificacion = array(
                    'message' => 'La fecha de fin esta en un rango existente',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                if ($date_entre > 0) {
                    $notificacion = array(
                        'message' => 'Existen datos dentro del rango de fechas',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    if ($validator->fails()) {
                        $notificacion = array(
                            'message' => 'La fecha de inicio debe ser menor a la fecha final',
                            'alert-type' => 'error'
                        );
                        return back()->with($notificacion)
                            ->with('error_code', 1)
                            ->withInput();
                    } else {
                        $tipogestion = new TipoCalificaciones;
                        $tipogestion->nombre = $request->input('nombre');
                        $tipogestion->fecha_inicial = $request->input('inicio');
                        $tipogestion->fecha_final = $request->input('fin');
                        $tipogestion->estado = '0';
                        $tipogestion->save();
                        return back();
                    }
                }
            }
        }
    }

    //EDITAR
    public function areaEditar(Request $request)
    {
        $id = $request->input('pkarea');
        $area = Areas::find($id);
        $area->nombre = $request->input('editnombre');
        $area->save();
        return back();
    }

    public function nivelEditar(Request $request)
    {
        $id = $request->input('pknivel');
        $nivel = Niveles::find($id);
        $nivel->nombre = $request->input('editnombre');
        $nivel->save();
        return back();
    }

    public function turnoEditar(Request $request)
    {
        $id = $request->input('pkturno');
        $turno = Turnos::find($id);
        $turno->nombre = $request->input('editnombre');
        $turno->save();
        return back();
    }

    public function gestionEditar(Request $request)
    {
        $id = $request->input('pkgestion');
        $gestion = Gestiones::find($id);
        $gestion->descripcion = $request->input('editdescripcion');
        $gestion->save();
        return back();
    }

    public function TcalificacionEditar(Request $request)
    {
        $id = $request->input('pkTCalificacion');
        $tipo = TipoCalificaciones::find($id);
        $tipo->nombre = $request->input('editnombre');
        $tipo->save();
        return back();
    }

    //Cerrar Desactivar
    public function gestionClose()
    {
        $id = Gestiones::max('id');
        $gestion = Gestiones::find($id);
        $gestion->estado = '1';
        $gestion->save();
        return back();
    }

    //DELETE
    public function areaDelete($id)
    {
        try {
            $area = Areas::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Areas::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }

    }

    public function niveleDelete($id)
    {
        try {
            $area = Niveles::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Niveles::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function turnoDelete($id)
    {
        try {
            $area = Turnos::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Turnos::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function gestionDelete($id)
    {
        try {
            $area = Gestiones::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Gestiones::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function TcalificacionDelete($id)
    {
        try {
            $area = TipoCalificaciones::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = TipoCalificaciones::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }
}
