<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FetchController extends Controller
{
    public function tutorcomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('personas')
                ->join('tutores', 'personas.id', '=', 'tutores.id_persona')
                ->where([['ci', 'like', "%{$query}%"]])
                ->orWhere([['nombre', 'like', "%{$query}%"]])
                ->orWhere([['apellidopat', 'like', "%{$query}%"]])
                ->orWhere([['apellidomat', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 caja" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->ci . ' - ' . $row->nombre . ' ' . $row->apellidopat . ' ' . $row->apellidomat . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function areasearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $areas = DB::table('areas')->where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($areas as $area) {
                $output .= '<option value="' . $area->id . '">' . $area->nombre . '</option>';
            }
            echo $output;
        }
    }

    public function nivelsearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $niveles = DB::table('niveles')->where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($niveles as $nivel) {
                $output .= '<option value="' . $nivel->id . '">' . $nivel->nombre . '</option>';
            }
            echo $output;
        }
    }
}
